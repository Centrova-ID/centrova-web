<?php

namespace App\Services;

use App\Models\Account\Session;
use App\Models\Account\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DeviceSessionServiceOptimized
{
    /**
     * Get all active sessions for a user with optimized queries.
     */
    public function getUserSessions(int $userId): Collection
    {
        // Cache sessions for 2 minutes to reduce database load
        $cacheKey = "user_sessions_{$userId}";
        
        return Cache::remember($cacheKey, 120, function () use ($userId) {
            return $this->fetchUserSessionsFromDB($userId);
        });
    }

    /**
     * Fetch sessions from database with optimized query
     */
    private function fetchUserSessionsFromDB(int $userId): Collection
    {
        // Use specific select to reduce data transfer
        $sessions = DB::connection('account')
            ->table('sessions')
            ->select([
                'id', 'user_id', 'ip_address', 'user_agent', 
                'last_activity', 'created_at'
            ])
            ->where('user_id', $userId)
            ->orderBy('last_activity', 'desc')
            ->limit(50) // Limit to prevent performance issues with users having many sessions
            ->get();

        return $sessions->map(function ($session) {
            return [
                'id' => $session->id,
                'device_type' => $this->parseDeviceType($session->user_agent),
                'browser' => $this->parseBrowser($session->user_agent),
                'operating_system' => $this->parseOperatingSystem($session->user_agent),
                'ip_address' => $session->ip_address,
                'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity),
                'time_ago' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                'device_icon' => $this->getDeviceIcon($this->parseDeviceType($session->user_agent)),
                'is_current' => $this->isCurrentSession($session->id),
                'user_agent' => $session->user_agent,
                'location' => $this->getLocationFromIP($session->ip_address),
                'created_at' => $session->created_at ? \Carbon\Carbon::parse($session->created_at) : null
            ];
        });
    }

    /**
     * Get active sessions only (within last 30 minutes) with optimized query.
     */
    public function getActiveSessions(int $userId): Collection
    {
        $activeThreshold = now()->subMinutes(30)->timestamp;
        
        $cacheKey = "active_sessions_{$userId}";
        
        return Cache::remember($cacheKey, 60, function () use ($userId, $activeThreshold) {
            $sessions = DB::connection('account')
                ->table('sessions')
                ->select([
                    'id', 'user_id', 'ip_address', 'user_agent', 
                    'last_activity', 'created_at'
                ])
                ->where('user_id', $userId)
                ->where('last_activity', '>=', $activeThreshold)
                ->orderBy('last_activity', 'desc')
                ->get();

            return $sessions->map(function ($session) {
                return [
                    'id' => $session->id,
                    'device_type' => $this->parseDeviceType($session->user_agent),
                    'browser' => $this->parseBrowser($session->user_agent),
                    'operating_system' => $this->parseOperatingSystem($session->user_agent),
                    'ip_address' => $session->ip_address,
                    'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity),
                    'time_ago' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    'device_icon' => $this->getDeviceIcon($this->parseDeviceType($session->user_agent)),
                    'is_current' => $this->isCurrentSession($session->id),
                    'user_agent' => $session->user_agent,
                    'location' => $this->getLocationFromIP($session->ip_address),
                    'created_at' => $session->created_at ? \Carbon\Carbon::parse($session->created_at) : null
                ];
            });
        });
    }

    /**
     * Get session by ID for a specific user with optimized query.
     */
    public function getSessionById(string $sessionId, int $userId): ?array
    {
        $cacheKey = "session_detail_{$sessionId}_{$userId}";
        
        return Cache::remember($cacheKey, 300, function () use ($sessionId, $userId) {
            // Optimized single query with specific columns
            $session = DB::connection('account')
                ->table('sessions')
                ->select([
                    'id', 'user_id', 'ip_address', 'user_agent', 
                    'last_activity', 'created_at'
                ])
                ->where('id', $sessionId)
                ->where('user_id', $userId)
                ->first();

            if (!$session) {
                return null;
            }

            // Optimized query for recent login - use the new index
            $recentLogin = DB::connection('account')
                ->table('user_login_activities')
                ->select(['login_at', 'browser', 'device_type', 'location'])
                ->where('user_id', $userId)
                ->where('ip_address', $session->ip_address)
                ->where('login_status', 'success')
                ->orderBy('login_at', 'desc')
                ->first();

            return [
                'id' => $session->id,
                'device_type' => $this->parseDeviceType($session->user_agent),
                'browser' => $this->parseBrowser($session->user_agent),
                'operating_system' => $this->parseOperatingSystem($session->user_agent),
                'ip_address' => $session->ip_address,
                'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity),
                'time_ago' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                'device_icon' => $this->getDeviceIcon($this->parseDeviceType($session->user_agent)),
                'is_current' => $this->isCurrentSession($session->id),
                'user_agent' => $session->user_agent,
                'location' => $this->getLocationFromIP($session->ip_address),
                'full_user_agent' => $session->user_agent,
                'raw_last_activity' => $session->last_activity,
                'created_at' => $session->created_at ? \Carbon\Carbon::parse($session->created_at) : null,
                'login_at' => $recentLogin ? \Carbon\Carbon::parse($recentLogin->login_at) : null
            ];
        });
    }

    /**
     * Get device statistics for a user with optimized single query.
     */
    public function getDeviceStats(int $userId): array
    {
        $cacheKey = "device_stats_{$userId}";
        
        return Cache::remember($cacheKey, 300, function () use ($userId) {
            $activeThreshold = now()->subMinutes(30)->timestamp;
            
            // Single optimized query for all stats
            $stats = DB::connection('account')
                ->table('sessions')
                ->selectRaw('
                    COUNT(*) as total_sessions,
                    COUNT(CASE WHEN last_activity >= ? THEN 1 END) as active_sessions,
                    COUNT(DISTINCT ip_address) as unique_ips
                ')
                ->where('user_id', $userId)
                ->setBindings([$activeThreshold])
                ->first();

            // Get device type distribution in a separate optimized query
            $deviceTypes = DB::connection('account')
                ->table('sessions')
                ->selectRaw('user_agent, COUNT(*) as count')
                ->where('user_id', $userId)
                ->groupBy('user_agent')
                ->get()
                ->groupBy(function ($session) {
                    return $this->parseDeviceType($session->user_agent);
                })
                ->map->count();

            return [
                'total_sessions' => $stats->total_sessions ?? 0,
                'active_sessions' => $stats->active_sessions ?? 0,
                'unique_ips' => $stats->unique_ips ?? 0,
                'device_types' => $deviceTypes,
                'browsers' => [],  // Can be populated if needed
                'operating_systems' => []  // Can be populated if needed
            ];
        });
    }

    /**
     * Revoke all sessions except current session with optimized query.
     */
    public function revokeAllOtherSessions(int $userId): int
    {
        $currentSessionId = session()->getId();
        
        $revokedCount = DB::connection('account')
            ->table('sessions')
            ->where('user_id', $userId)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        // Clear cache after revoking sessions
        $this->clearUserSessionCache($userId);

        return $revokedCount;
    }

    /**
     * Force revoke ALL sessions including current session.
     */
    public function forceRevokeAllSessions(int $userId): int
    {
        $revokedCount = DB::connection('account')
            ->table('sessions')
            ->where('user_id', $userId)
            ->delete();
        
        // Clear cache
        $this->clearUserSessionCache($userId);
        
        // Invalidate current session
        session()->invalidate();
        session()->regenerateToken();
        
        return $revokedCount;
    }

    /**
     * Revoke a specific session with optimized query.
     */
    public function revokeSession(string $sessionId, int $userId): bool
    {
        // Don't allow revoking current session
        if ($this->isCurrentSession($sessionId)) {
            return false;
        }

        $deleted = DB::connection('account')
            ->table('sessions')
            ->where('id', $sessionId)
            ->where('user_id', $userId)
            ->delete();

        if ($deleted) {
            // Clear specific cache entries
            $this->clearUserSessionCache($userId);
            Cache::forget("session_detail_{$sessionId}_{$userId}");
        }

        return $deleted > 0;
    }

    /**
     * Clear all session-related cache for a user
     */
    public function clearUserSessionCache(int $userId): void
    {
        Cache::forget("user_sessions_{$userId}");
        Cache::forget("active_sessions_{$userId}");
        Cache::forget("device_stats_{$userId}");
    }

    /**
     * Parse device type from user agent (optimized)
     */
    private function parseDeviceType(string $userAgent): string
    {
        $userAgent = strtolower($userAgent);
        
        if (strpos($userAgent, 'ipad') !== false || strpos($userAgent, 'tablet') !== false) {
            return 'tablet';
        }
        
        if (strpos($userAgent, 'mobile') !== false || 
            strpos($userAgent, 'android') !== false || 
            strpos($userAgent, 'iphone') !== false) {
            return 'mobile';
        }
        
        return 'desktop';
    }

    /**
     * Parse browser from user agent (optimized)
     */
    private function parseBrowser(string $userAgent): string
    {
        if (preg_match('/Chrome\/[\d.]+/', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/Firefox\/[\d.]+/', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/Safari\/[\d.]+/', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/Edge\/[\d.]+/', $userAgent)) {
            return 'Edge';
        } elseif (preg_match('/Opera\/[\d.]+/', $userAgent)) {
            return 'Opera';
        }
        
        return 'Unknown Browser';
    }

    /**
     * Parse operating system from user agent (optimized)
     */
    private function parseOperatingSystem(string $userAgent): string
    {
        if (preg_match('/Windows NT [\d.]+/', $userAgent)) {
            return 'Windows';
        } elseif (preg_match('/Mac OS X [\d_]+/', $userAgent)) {
            return 'macOS';
        } elseif (preg_match('/Android [\d.]+/', $userAgent)) {
            return 'Android';
        } elseif (preg_match('/iPhone OS [\d_]+/', $userAgent)) {
            return 'iOS';
        } elseif (preg_match('/Linux/', $userAgent)) {
            return 'Linux';
        }
        
        return 'Unknown OS';
    }

    /**
     * Get device icon based on device type
     */
    private function getDeviceIcon(string $deviceType): string
    {
        switch ($deviceType) {
            case 'mobile':
                return 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z';
            case 'tablet':
                return 'M12 18h.01M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z';
            default:
                return 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z';
        }
    }

    /**
     * Check if session is current session
     */
    private function isCurrentSession(string $sessionId): bool
    {
        return session()->getId() === $sessionId;
    }

    /**
     * Get location from IP address with caching and optimization
     */
    private function getLocationFromIP(string $ipAddress): string
    {
        // For local/private IPs
        if (in_array($ipAddress, ['127.0.0.1', '::1', 'localhost']) || 
            preg_match('/^192\.168\./', $ipAddress) ||
            preg_match('/^10\./', $ipAddress) ||
            preg_match('/^172\.(1[6-9]|2[0-9]|3[0-1])\./', $ipAddress)) {
            return '[Jaringan Lokal, Indonesia]';
        }

        // Cache for 24 hours
        return Cache::remember("location_ip_{$ipAddress}", 60 * 60 * 24, function () use ($ipAddress) {
            try {
                $response = @file_get_contents("http://ip-api.com/json/{$ipAddress}?fields=country,regionName,city&lang=id", false, stream_context_create([
                    'http' => [
                        'timeout' => 3 // Quick timeout to avoid blocking
                    ]
                ]));
                
                if ($response) {
                    $data = json_decode($response, true);
                    if ($data && isset($data['country'])) {
                        $location = [];
                        if (!empty($data['city'])) $location[] = $data['city'];
                        if (!empty($data['regionName'])) $location[] = $data['regionName'];
                        if (!empty($data['country'])) $location[] = $data['country'];
                        
                        return implode(', ', $location) ?: '[Lokasi Tidak Diketahui]';
                    }
                }
            } catch (\Exception $e) {
                Log::warning('IP geolocation failed', ['ip' => $ipAddress, 'error' => $e->getMessage()]);
            }
            
            return '[Lokasi Tidak Diketahui]';
        });
    }
}
