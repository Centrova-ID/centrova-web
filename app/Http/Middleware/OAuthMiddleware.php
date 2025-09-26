<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\OAuth\OAuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OAuthMiddleware
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$requiredScopes): Response
    {
        // Extract bearer token
        $token = $request->bearerToken();
        
        if (!$token) {
            return $this->unauthorizedResponse('No access token provided');
        }

        // Validate access token
        $accessToken = $this->oauthService->validateAccessToken($token);
        
        if (!$accessToken) {
            return $this->unauthorizedResponse('Invalid or expired access token');
        }

        // Check required scopes if specified
        foreach ($requiredScopes as $scope) {
            if (!$accessToken->hasScope($scope)) {
                return $this->forbiddenResponse("Required scope '$scope' not granted");
            }
        }

        // Add user and access token to request
        $request->merge([
            'oauth_user' => $accessToken->user,
            'oauth_access_token' => $accessToken,
            'oauth_client' => $accessToken->client,
            'oauth_scopes' => $accessToken->scopes ?? []
        ]);

        return $next($request);
    }

    /**
     * Return unauthorized response.
     */
    protected function unauthorizedResponse(string $message): JsonResponse
    {
        return response()->json([
            'error' => 'invalid_token',
            'error_description' => $message
        ], 401);
    }

    /**
     * Return forbidden response.
     */
    protected function forbiddenResponse(string $message): JsonResponse
    {
        return response()->json([
            'error' => 'insufficient_scope',
            'error_description' => $message
        ], 403);
    }
}
