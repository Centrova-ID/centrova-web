<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Services\OAuth\OAuthService;
use App\Models\OAuth\OAuthClient;
use App\Models\OAuth\OAuthScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OAuthController extends Controller
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    /**
     * Show OAuth authorization form.
     */
    public function showAuthorizationForm(Request $request)
    {
        try {
            // Validate request parameters
            $params = $this->oauthService->validateAuthorizationRequest($request);
            
            // Validate client
            $client = $this->oauthService->validateClient($params['client_id'], $params['redirect_uri']);
            
            // Validate scopes
            $scopes = $this->oauthService->validateScopes($params['scope'] ?? null, $client);
            
            // If user is not authenticated, redirect to login
            if (!Auth::check()) {
                $request->session()->put('oauth_params', $params);
                return redirect()->route('login')
                    ->with('info', 'Please log in to authorize the application.');
            }

            // Get scope details for display
            $scopeDetails = OAuthScope::whereIn('scope', $scopes)->get();

            return view('oauth.authorize', [
                'client' => $client,
                'scopes' => $scopeDetails,
                'params' => $params
            ]);

        } catch (\Exception $e) {
            Log::error('OAuth Authorization Error: ' . $e->getMessage());
            
            // If we have a redirect URI, redirect with error
            if (isset($params['redirect_uri'])) {
                $errorParams = [
                    'error' => 'invalid_request',
                    'error_description' => $e->getMessage()
                ];
                
                if (isset($params['state'])) {
                    $errorParams['state'] = $params['state'];
                }
                
                return redirect($params['redirect_uri'] . '?' . http_build_query($errorParams));
            }
            
            return response()->json([
                'error' => 'invalid_request',
                'error_description' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Handle authorization approval/denial.
     */
    public function approve(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required|string',
                'redirect_uri' => 'required|url',
                'scope' => 'nullable|string',
                'state' => 'nullable|string',
                'code_challenge' => 'nullable|string',
                'code_challenge_method' => 'nullable|string',
                'action' => 'required|in:approve,deny'
            ]);

            // Get redirect URI
            $redirectUri = $request->redirect_uri;
            $state = $request->state;

            // If user denied, redirect with error
            if ($request->action === 'deny') {
                $errorParams = [
                    'error' => 'access_denied',
                    'error_description' => 'The user denied the request'
                ];
                
                if ($state) {
                    $errorParams['state'] = $state;
                }
                
                return redirect($redirectUri . '?' . http_build_query($errorParams));
            }

            // User approved, validate everything again
            $client = $this->oauthService->validateClient($request->client_id, $request->redirect_uri);
            $scopes = $this->oauthService->validateScopes($request->scope, $client);

            // Create authorization code
            $authCode = $this->oauthService->createAuthorizationCode(
                $client,
                Auth::user(),
                $request->redirect_uri,
                $scopes,
                $request->code_challenge,
                $request->code_challenge_method
            );

            // Redirect with authorization code
            $successParams = [
                'code' => $authCode->code
            ];
            
            if ($state) {
                $successParams['state'] = $state;
            }

            return redirect($redirectUri . '?' . http_build_query($successParams));

        } catch (\Exception $e) {
            Log::error('OAuth Approval Error: ' . $e->getMessage());
            
            $errorParams = [
                'error' => 'server_error',
                'error_description' => 'An error occurred while processing your request'
            ];
            
            if ($request->state) {
                $errorParams['state'] = $request->state;
            }
            
            return redirect($request->redirect_uri . '?' . http_build_query($errorParams));
        }
    }

    /**
     * Exchange authorization code for access token.
     */
    public function token(Request $request)
    {
        try {
            $request->validate([
                'grant_type' => 'required|in:authorization_code,refresh_token',
                'client_id' => 'required|string',
                'client_secret' => 'nullable|string',
            ]);

            if ($request->grant_type === 'authorization_code') {
                $request->validate([
                    'code' => 'required|string',
                    'redirect_uri' => 'required|url',
                    'code_verifier' => 'nullable|string'
                ]);

                $response = $this->oauthService->exchangeCodeForToken(
                    $request->code,
                    $request->client_id,
                    $request->client_secret,
                    $request->redirect_uri,
                    $request->code_verifier
                );

            } elseif ($request->grant_type === 'refresh_token') {
                $request->validate([
                    'refresh_token' => 'required|string',
                    'scope' => 'nullable|string'
                ]);

                $response = $this->oauthService->refreshToken(
                    $request->refresh_token,
                    $request->client_id,
                    $request->client_secret,
                    $request->scope
                );
            }

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('OAuth Token Error: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'invalid_request',
                'error_description' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Revoke access or refresh token.
     */
    public function revoke(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required|string',
                'client_id' => 'required|string',
                'client_secret' => 'nullable|string',
                'token_type_hint' => 'nullable|in:access_token,refresh_token'
            ]);

            $revoked = $this->oauthService->revokeToken(
                $request->token,
                $request->client_id,
                $request->client_secret,
                $request->token_type_hint ?? 'access_token'
            );

            if ($revoked) {
                return response()->json(['message' => 'Token revoked successfully']);
            } else {
                return response()->json(['message' => 'Token not found'], 200);
            }

        } catch (\Exception $e) {
            Log::error('OAuth Revoke Error: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'invalid_request',
                'error_description' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get user info (OpenID Connect userinfo endpoint).
     */
    public function userinfo(Request $request)
    {
        try {
            // Extract bearer token
            $token = $request->bearerToken();
            
            if (!$token) {
                return response()->json([
                    'error' => 'invalid_token',
                    'error_description' => 'No access token provided'
                ], 401);
            }

            // Validate access token
            $accessToken = $this->oauthService->validateAccessToken($token);
            
            if (!$accessToken) {
                return response()->json([
                    'error' => 'invalid_token',
                    'error_description' => 'Invalid or expired access token'
                ], 401);
            }

            // Get user
            $user = $accessToken->user;
            
            if (!$user) {
                return response()->json([
                    'error' => 'invalid_token',
                    'error_description' => 'User not found'
                ], 401);
            }

            // Build response based on granted scopes
            $response = [];
            
            if ($accessToken->hasScope('openid')) {
                $response['sub'] = (string) $user->id;
            }
            
            if ($accessToken->hasScope('profile')) {
                $response['name'] = $user->name;
                $response['preferred_username'] = $user->username;
                
                // Add avatar URL if available
                if ($user->avatar_url) {
                    $response['picture'] = $user->avatar_url;
                }
                
                if ($user->birth_date) {
                    $response['birthdate'] = $user->birth_date;
                }
            }
            
            if ($accessToken->hasScope('email')) {
                $response['email'] = $user->email;
                $response['email_verified'] = !is_null($user->email_verified_at);
            }
            
            if ($accessToken->hasScope('phone') && $user->phone) {
                $response['phone_number'] = $user->phone;
            }
            
            if ($accessToken->hasScope('address') && $user->address) {
                $response['address'] = [
                    'formatted' => $user->address
                ];
            }

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('OAuth UserInfo Error: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'server_error',
                'error_description' => 'An error occurred while processing your request'
            ], 500);
        }
    }

    /**
     * OpenID Connect Discovery endpoint.
     */
    public function discovery()
    {
        return response()->json([
            'issuer' => config('app.url'),
            'authorization_endpoint' => route('oauth.authorize'),
            'token_endpoint' => route('oauth.token'),
            'userinfo_endpoint' => route('oauth.userinfo'),
            'revocation_endpoint' => route('oauth.revoke'),
            'jwks_uri' => route('oauth.jwks'),
            'response_types_supported' => ['code'],
            'grant_types_supported' => ['authorization_code', 'refresh_token'],
            'subject_types_supported' => ['public'],
            'id_token_signing_alg_values_supported' => ['none'],
            'scopes_supported' => OAuthScope::pluck('scope')->toArray(),
            'token_endpoint_auth_methods_supported' => ['client_secret_post', 'client_secret_basic'],
            'claims_supported' => ['sub', 'name', 'preferred_username', 'picture', 'email', 'email_verified', 'phone_number', 'address', 'birthdate'],
            'code_challenge_methods_supported' => ['S256', 'plain']
        ]);
    }

    /**
     * JWKS endpoint (for ID tokens if implemented later).
     */
    public function jwks()
    {
        return response()->json(['keys' => []]);
    }
}
