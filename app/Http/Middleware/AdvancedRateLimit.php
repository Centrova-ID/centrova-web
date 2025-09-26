<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class AdvancedRateLimit
{
    /**
     * Handle an incoming request with advanced rate limiting.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $type = 'login'): Response
    {
        $rateLimits = $this->getRateLimits($type);
        
        foreach ($rateLimits as $limitConfig) {
            $key = $this->buildRateLimitKey($request, $limitConfig['scope']);
            
            if (RateLimiter::tooManyAttempts($key, $limitConfig['attempts'])) {
                $this->handleRateLimitExceeded($request, $key, $limitConfig);
                
                throw new ThrottleRequestsException(
                    'Rate limit exceeded. Please try again later.',
                    null,
                    [],
                    RateLimiter::availableIn($key)
                );
            }
            
            RateLimiter::hit($key, $limitConfig['decay']);
        }

        $response = $next($request);

        // Log successful attempts for security monitoring
        if ($response->isSuccessful()) {
            $this->logSecurityEvent($request, $type, 'success');
        } else {
            $this->logSecurityEvent($request, $type, 'failure');
        }

        return $response;
    }

    /**
     * Get rate limit configurations based on type
     */
    private function getRateLimits(string $type): array
    {
        $configs = [
            'login' => [
                ['scope' => 'ip', 'attempts' => 10, 'decay' => 3600], // 10 attempts per hour per IP
                ['scope' => 'user', 'attempts' => 5, 'decay' => 900], // 5 attempts per 15 min per user
            ],
            '2fa' => [
                ['scope' => 'ip', 'attempts' => 15, 'decay' => 3600], // 15 attempts per hour per IP
                ['scope' => 'user', 'attempts' => 10, 'decay' => 1800], // 10 attempts per 30 min per user
            ],
            'recovery' => [
                ['scope' => 'ip', 'attempts' => 3, 'decay' => 7200], // 3 attempts per 2 hours per IP
                ['scope' => 'user', 'attempts' => 5, 'decay' => 3600], // 5 attempts per hour per user
            ],
            'password_reset' => [
                ['scope' => 'ip', 'attempts' => 5, 'decay' => 3600], // 5 requests per hour per IP
                ['scope' => 'email', 'attempts' => 3, 'decay' => 1800], // 3 requests per 30 min per email
            ],
        ];

        return $configs[$type] ?? $configs['login'];
    }

    /**
     * Build rate limit key based on scope
     */
    private function buildRateLimitKey(Request $request, string $scope): string
    {
        $baseKey = "rate_limit:{$scope}:";
        
        switch ($scope) {
            case 'ip':
                return $baseKey . $request->ip();
            
            case 'user':
                // Use email/username from request or session
                $identifier = $request->input('login') ?? 
                            $request->input('email') ?? 
                            session('2fa_user_id') ?? 
                            ($request->user() ? $request->user()->id : $request->ip());
                return $baseKey . hash('sha256', $identifier);
            
            case 'email':
                $email = $request->input('email') ?? $request->input('login');
                return $baseKey . hash('sha256', $email ?? $request->ip());
            
            default:
                return $baseKey . $request->ip();
        }
    }

    /**
     * Handle rate limit exceeded scenario
     */
    private function handleRateLimitExceeded(Request $request, string $key, array $config): void
    {
        // Log security event
        $this->logSecurityEvent($request, 'rate_limit_exceeded', 'blocked', [
            'key' => $key,
            'scope' => $config['scope'],
            'attempts' => $config['attempts'],
        ]);

        // If this is a user-based limit and we have user info, lock the account temporarily
        if ($config['scope'] === 'user' && $this->shouldLockAccount($request)) {
            $this->lockUserAccount($request);
        }

        // Store lockout information for display
        session(['lockout_info' => [
            'locked_until' => now()->addSeconds(RateLimiter::availableIn($key)),
            'attempts_left' => 0,
            'scope' => $config['scope'],
        ]]);
    }

    /**
     * Determine if account should be locked
     */
    private function shouldLockAccount(Request $request): bool
    {
        $identifier = $request->input('login') ?? $request->input('email');
        
        if (!$identifier) {
            return false;
        }

        // Check if this identifier has had multiple rate limit violations
        $violationKey = "account_violations:" . hash('sha256', $identifier);
        $violations = Cache::get($violationKey, 0);
        
        if ($violations >= 3) { // 3 rate limit violations = account lock
            return true;
        }

        // Increment violation count
        Cache::put($violationKey, $violations + 1, 3600); // Store for 1 hour
        
        return false;
    }

    /**
     * Lock user account temporarily
     */
    private function lockUserAccount(Request $request): void
    {
        $identifier = $request->input('login') ?? $request->input('email');
        
        if ($identifier) {
            Cache::put(
                "account_locked:" . hash('sha256', $identifier),
                true,
                1800 // Lock for 30 minutes
            );
            
            session(['locked_identifier' => $identifier]);
        }
    }

    /**
     * Log security events for monitoring
     */
    private function logSecurityEvent(Request $request, string $type, string $result, array $extra = []): void
    {
        $logData = [
            'timestamp' => now()->toISOString(),
            'type' => $type,
            'result' => $result,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'identifier' => $request->input('login') ?? $request->input('email'),
            'session_id' => session()->getId(),
        ];

        // Add extra data
        $logData = array_merge($logData, $extra);

        // Log to security log channel
        logger()->channel('security')->info('Security event', $logData);
        
        // For high-risk events, also send alerts
        if (in_array($result, ['blocked', 'account_locked', 'suspicious'])) {
            $this->sendSecurityAlert($logData);
        }
    }

    /**
     * Send security alerts for critical events
     */
    private function sendSecurityAlert(array $logData): void
    {
        // Implement your alerting mechanism here
        // This could be email, Slack, SMS, or external monitoring service
        
        // Example: Store in high-priority queue for immediate processing
        // dispatch(new SecurityAlertJob($logData))->onQueue('security-alerts');
    }
}
