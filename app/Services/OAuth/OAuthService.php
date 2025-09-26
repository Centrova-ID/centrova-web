<?php

namespace App\Services\OAuth;

use App\Models\OAuth\OAuthClient;
use App\Models\OAuth\OAuthAuthorizationCode;
use App\Models\OAuth\OAuthAccessToken;
use App\Models\OAuth\OAuthRefreshToken;
use App\Models\OAuth\OAuthScope;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OAuthService
{
    /**
     * Validate authorization request parameters.
     */
    public function validateAuthorizationRequest(Request $request): array
    {
        $request->validate([
            'response_type' => 'required|in:code',
            'client_id' => 'required|string',
            'redirect_uri' => 'required|url',
            'scope' => 'nullable|string',
            'state' => 'nullable|string',
            'code_challenge' => 'nullable|string',
            'code_challenge_method' => 'nullable|in:S256,plain'
        ]);

        return $request->only([
            'response_type',
            'client_id',
            'redirect_uri',
            'scope',
            'state',
            'code_challenge',
            'code_challenge_method'
        ]);
    }

    /**
     * Find and validate OAuth client.
     */
    public function validateClient(string $clientId, ?string $redirectUri = null): OAuthClient
    {
        $client = OAuthClient::where('client_id', $clientId)
            ->where('is_active', true)
            ->first();

        if (!$client) {
            throw new \Exception('Invalid client');
        }

        if ($redirectUri && !$client->isValidRedirectUri($redirectUri)) {
            throw new \Exception('Invalid redirect URI');
        }

        return $client;
    }

    /**
     * Validate and parse scopes.
     */
    public function validateScopes(?string $scopeString, OAuthClient $client): array
    {
        if (!$scopeString) {
            return OAuthScope::getDefaultScopes()->pluck('scope')->toArray();
        }

        $requestedScopes = explode(' ', trim($scopeString));
        
        // Remove duplicates and empty values
        $requestedScopes = array_unique(array_filter($requestedScopes));

        // Validate that all requested scopes exist
        if (!OAuthScope::validateScopes($requestedScopes)) {
            throw new \Exception('Invalid scope');
        }

        // Check if client can access all requested scopes
        foreach ($requestedScopes as $scope) {
            if (!$client->canAccessScope($scope)) {
                throw new \Exception("Client not authorized for scope: $scope");
            }
        }

        return $requestedScopes;
    }

    /**
     * Create authorization code.
     */
    public function createAuthorizationCode(
        OAuthClient $client,
        User $user,
        string $redirectUri,
        array $scopes,
        ?string $codeChallenge = null,
        ?string $codeChallengeMethod = null
    ): OAuthAuthorizationCode {
        return OAuthAuthorizationCode::create([
            'client_id' => $client->client_id,
            'user_id' => $user->id,
            'redirect_uri' => $redirectUri,
            'scopes' => $scopes,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => $codeChallengeMethod,
        ]);
    }

    /**
     * Exchange authorization code for access token.
     */
    public function exchangeCodeForToken(
        string $code,
        string $clientId,
        ?string $clientSecret = null,
        ?string $redirectUri = null,
        ?string $codeVerifier = null
    ): array {
        // Find the authorization code
        $authCode = OAuthAuthorizationCode::where('code', $code)
            ->where('client_id', $clientId)
            ->first();

        if (!$authCode || !$authCode->isValid()) {
            throw new \Exception('Invalid or expired authorization code');
        }

        // Verify redirect URI matches
        if ($redirectUri && $authCode->redirect_uri !== $redirectUri) {
            throw new \Exception('Invalid redirect URI');
        }

        // Verify PKCE if present
        if ($authCode->code_challenge && !$authCode->verifyCodeChallenge($codeVerifier)) {
            throw new \Exception('Invalid code verifier');
        }

        // Verify client secret for confidential clients
        if ($authCode->client->is_confidential) {
            if (!$clientSecret || !$authCode->client->verifySecret($clientSecret)) {
                throw new \Exception('Invalid client credentials');
            }
        }

        // Revoke the authorization code (it can only be used once)
        $authCode->revoke();

        // Create access token
        $accessToken = OAuthAccessToken::create([
            'client_id' => $clientId,
            'user_id' => $authCode->user_id,
            'scopes' => $authCode->scopes,
        ]);

        $response = [
            'access_token' => $accessToken->token,
            'token_type' => 'Bearer',
            'expires_in' => $accessToken->expires_at->diffInSeconds(now()),
            'scope' => $accessToken->getScopesString(),
        ];

        // Create refresh token if offline_access scope is requested
        if (in_array('offline_access', $authCode->scopes ?? [])) {
            $refreshToken = OAuthRefreshToken::create([
                'access_token' => $accessToken->token,
            ]);

            $response['refresh_token'] = $refreshToken->token;
        }

        return $response;
    }

    /**
     * Refresh access token using refresh token.
     */
    public function refreshToken(
        string $refreshToken,
        string $clientId,
        ?string $clientSecret = null,
        ?string $scope = null
    ): array {
        // Find the refresh token
        $refreshTokenModel = OAuthRefreshToken::where('token', $refreshToken)->first();

        if (!$refreshTokenModel || !$refreshTokenModel->isValid()) {
            throw new \Exception('Invalid or expired refresh token');
        }

        $accessToken = $refreshTokenModel->accessToken;
        
        if (!$accessToken) {
            throw new \Exception('Invalid refresh token');
        }

        // Verify client
        if ($accessToken->client_id !== $clientId) {
            throw new \Exception('Invalid client');
        }

        // Verify client secret for confidential clients
        if ($accessToken->client->is_confidential) {
            if (!$clientSecret || !$accessToken->client->verifySecret($clientSecret)) {
                throw new \Exception('Invalid client credentials');
            }
        }

        // Parse requested scopes
        $requestedScopes = $scope ? explode(' ', trim($scope)) : $accessToken->scopes;

        // Validate that requested scopes are subset of original scopes
        foreach ($requestedScopes as $requestedScope) {
            if (!in_array($requestedScope, $accessToken->scopes ?? [])) {
                throw new \Exception("Requested scope '$requestedScope' not in original grant");
            }
        }

        // Revoke old tokens
        $accessToken->revoke();
        $refreshTokenModel->revoke();

        // Create new access token
        $newAccessToken = OAuthAccessToken::create([
            'client_id' => $clientId,
            'user_id' => $accessToken->user_id,
            'scopes' => $requestedScopes,
        ]);

        $response = [
            'access_token' => $newAccessToken->token,
            'token_type' => 'Bearer',
            'expires_in' => $newAccessToken->expires_at->diffInSeconds(now()),
            'scope' => $newAccessToken->getScopesString(),
        ];

        // Create new refresh token
        $newRefreshToken = OAuthRefreshToken::create([
            'access_token' => $newAccessToken->token,
        ]);

        $response['refresh_token'] = $newRefreshToken->token;

        return $response;
    }

    /**
     * Validate access token.
     */
    public function validateAccessToken(string $token): ?OAuthAccessToken
    {
        return OAuthAccessToken::where('token', $token)
            ->where('revoked', false)
            ->where('expires_at', '>', now())
            ->first();
    }

    /**
     * Revoke token.
     */
    public function revokeToken(
        string $token,
        string $clientId,
        ?string $clientSecret = null,
        string $tokenTypeHint = 'access_token'
    ): bool {
        // Try to find as access token first
        $accessToken = OAuthAccessToken::where('token', $token)
            ->where('client_id', $clientId)
            ->first();

        if ($accessToken) {
            // Verify client secret for confidential clients
            if ($accessToken->client->is_confidential) {
                if (!$clientSecret || !$accessToken->client->verifySecret($clientSecret)) {
                    throw new \Exception('Invalid client credentials');
                }
            }

            $accessToken->revoke();
            return true;
        }

        // Try to find as refresh token
        $refreshToken = OAuthRefreshToken::where('token', $token)->first();
        
        if ($refreshToken) {
            $accessToken = $refreshToken->accessToken;
            
            if ($accessToken && $accessToken->client_id === $clientId) {
                // Verify client secret for confidential clients
                if ($accessToken->client->is_confidential) {
                    if (!$clientSecret || !$accessToken->client->verifySecret($clientSecret)) {
                        throw new \Exception('Invalid client credentials');
                    }
                }

                $refreshToken->revoke();
                return true;
            }
        }

        return false;
    }
}
