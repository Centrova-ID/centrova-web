<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class OAuthRateLimiter
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $endpoint = 'oauth'): Response
    {
        $key = $this->resolveRequestSignature($request, $endpoint);
        $maxAttempts = $this->getMaxAttempts($endpoint);
        $decayMinutes = $this->getDecayMinutes($endpoint);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = RateLimiter::availableIn($key);
            
            return response()->json([
                'error' => 'rate_limit_exceeded',
                'error_description' => 'Too many requests. Please try again later.',
                'retry_after' => $retryAfter
            ], 429, [
                'Retry-After' => $retryAfter,
                'X-RateLimit-Limit' => $maxAttempts,
                'X-RateLimit-Remaining' => 0,
                'X-RateLimit-Reset' => now()->addSeconds($retryAfter)->timestamp
            ]);
        }

        RateLimiter::hit($key, $decayMinutes * 60);
        
        $response = $next($request);

        // Add rate limit headers
        $remaining = $maxAttempts - RateLimiter::attempts($key);
        $resetTime = now()->addMinutes($decayMinutes)->timestamp;

        return $response->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => max(0, $remaining),
            'X-RateLimit-Reset' => $resetTime
        ]);
    }

    /**
     * Resolve request signature.
     */
    protected function resolveRequestSignature(Request $request, string $endpoint): string
    {
        if ($endpoint === 'token' && $request->filled('client_id')) {
            return "oauth_token:{$request->client_id}";
        }

        if ($endpoint === 'userinfo' && $request->bearerToken()) {
            return "oauth_userinfo:{$request->bearerToken()}";
        }

        if ($endpoint === 'authorize') {
            return "oauth_authorize:{$request->ip()}";
        }

        return "oauth_{$endpoint}:{$request->ip()}";
    }

    /**
     * Get max attempts for endpoint.
     */
    protected function getMaxAttempts(string $endpoint): int
    {
        return match($endpoint) {
            'authorize' => 10,
            'token' => 30,
            'userinfo' => 100,
            'revoke' => 20,
            default => 60
        };
    }

    /**
     * Get decay minutes for endpoint.
     */
    protected function getDecayMinutes(string $endpoint): int
    {
        return match($endpoint) {
            'authorize' => 1,
            'token' => 1,
            'userinfo' => 1,
            'revoke' => 1,
            default => 1
        };
    }
}
