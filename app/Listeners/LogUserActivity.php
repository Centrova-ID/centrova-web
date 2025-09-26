<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;
use App\Services\LoginActivityService;
use App\Events\UserLoginEvent;
use Jenssegers\Agent\Agent;

class LogUserActivity
{
    protected LoginActivityService $loginActivityService;

    public function __construct(LoginActivityService $loginActivityService)
    {
        $this->loginActivityService = $loginActivityService;
    }

    /**
     * Handle user login events.
     */
    public function handle($event)
    {
        $agent = new Agent();
        $request = Request::instance();
        
        // Get user info
        $user = null;
        $loginStatus = 'unknown';
        
        if ($event instanceof Login) {
            $user = $event->user;
            $loginStatus = 'success';
        } elseif ($event instanceof Failed) {
            $user = $event->user;
            $loginStatus = 'failed';
        } elseif ($event instanceof Logout) {
            $user = $event->user;
            $loginStatus = 'logout';
        }
        
        if (!$user || !$user->id) {
            return;
        }

        try {
            // Create fake request object with necessary data
            $fakeRequest = new \Illuminate\Http\Request();
            $fakeRequest->server->set('HTTP_USER_AGENT', $agent->getUserAgent());
            $fakeRequest->server->set('REMOTE_ADDR', $this->getRealIpAddress($request));
            
            // Create login activity record
            $loginActivity = $this->loginActivityService->logActivity(
                $user->id,
                $fakeRequest,
                $loginStatus,
                $loginStatus === 'failed' ? 'Authentication failed' : null,
                false
            );

            // Only trigger alerts for successful or failed logins (not logout)
            if (in_array($loginStatus, ['success', 'failed'])) {
                // Fire event for login alert processing
                event(new UserLoginEvent($loginActivity));
            }

        } catch (\Exception $e) {
            Log::error('Failed to log user activity', [
                'user_id' => $user->id,
                'event' => get_class($event),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Get real IP address
     */
    private function getRealIpAddress($request): string
    {
        $ipKeys = [
            'HTTP_CF_CONNECTING_IP',     // Cloudflare
            'HTTP_CLIENT_IP',            // Proxy
            'HTTP_X_FORWARDED_FOR',      // Load balancer/proxy
            'HTTP_X_FORWARDED',          // Proxy
            'HTTP_X_CLUSTER_CLIENT_IP',  // Cluster
            'HTTP_FORWARDED_FOR',        // Proxy
            'HTTP_FORWARDED',            // Proxy
            'REMOTE_ADDR'                // Standard
        ];

        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) && !empty($_SERVER[$key])) {
                $ips = explode(',', $_SERVER[$key]);
                $ip = trim($ips[0]);
                
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return $request->ip() ?? '127.0.0.1';
    }

    /**
     * Get location from IP address
     */
    private function getLocationFromIp(string $ipAddress): array
    {
        // Skip localhost/private IPs
        if (in_array($ipAddress, ['127.0.0.1', '::1']) || 
            filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return [
                'location' => 'Local/Private Network',
                'country_code' => 'LO',
                'city' => 'Localhost',
                'timezone' => 'UTC'
            ];
        }

        try {
            // You can integrate with services like ipapi.co, geoip, etc.
            // For now, return basic info
            return [
                'location' => 'Unknown Location',
                'country_code' => 'XX',
                'city' => 'Unknown',
                'timezone' => 'UTC'
            ];
        } catch (\Exception $e) {
            Log::warning('Failed to get location from IP', [
                'ip' => $ipAddress,
                'error' => $e->getMessage()
            ]);
            
            return [
                'location' => 'Unknown Location',
                'country_code' => 'XX',
                'city' => 'Unknown',
                'timezone' => 'UTC'
            ];
        }
    }

    /**
     * Get device type from user agent
     */
    private function getDeviceType(Agent $agent): string
    {
        if ($agent->isMobile()) {
            return 'mobile';
        } elseif ($agent->isTablet()) {
            return 'tablet';
        } elseif ($agent->isDesktop()) {
            return 'desktop';
        } elseif ($agent->isRobot()) {
            return 'robot';
        }
        
        return 'unknown';
    }
}
