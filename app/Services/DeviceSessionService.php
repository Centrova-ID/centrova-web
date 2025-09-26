<?php

namespace App\Services;

use App\Models\Account\Session;
use App\Models\Account\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DeviceSessionService
{
    /**
     * Get all active sessions for a user.
     */
    public function getUserSessions(int $userId): Collection
    {
        return Session::where('user_id', $userId)
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) {
                return [
                    'id' => $session->id,
                    'device_type' => $session->device_type,
                    'browser' => $session->browser,
                    'operating_system' => $session->operating_system,
                    'ip_address' => $session->ip_address,
                    'last_activity' => $session->getLastActivityAsCarbon(),
                    'time_ago' => $session->time_ago,
                    'device_icon' => $session->device_icon,
                    'is_current' => $session->isCurrentSession(),
                    'user_agent' => $session->user_agent,
                    'location' => $this->getLocationFromIP($session->ip_address),
                    'created_at' => $session->created_at ? \Carbon\Carbon::parse($session->created_at) : null
                ];
            });
    }

    /**
     * Get active sessions only (within last 30 minutes).
     */
    public function getActiveSessions(int $userId): Collection
    {
        return Session::where('user_id', $userId)
            ->active()
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) {
                return [
                    'id' => $session->id,
                    'device_type' => $session->device_type,
                    'browser' => $session->browser,
                    'operating_system' => $session->operating_system,
                    'ip_address' => $session->ip_address,
                    'last_activity' => $session->getLastActivityAsCarbon(),
                    'time_ago' => $session->time_ago,
                    'device_icon' => $session->device_icon,
                    'is_current' => $session->isCurrentSession(),
                    'user_agent' => $session->user_agent,
                    'location' => $this->getLocationFromIP($session->ip_address),
                    'created_at' => $session->created_at ? \Carbon\Carbon::parse($session->created_at) : null
                ];
            });
    }

    /**
     * Get session by ID for a specific user.
     */
    public function getSessionById(string $sessionId, int $userId): ?array
    {
        $session = Session::where('id', $sessionId)
            ->where('user_id', $userId)
            ->first();

        if (!$session) {
            return null;
        }

        // Try to find the most recent login activity for this session's IP and user agent
        $recentLogin = DB::connection('account')->table('user_login_activities')
            ->where('user_id', $userId)
            ->where('ip_address', $session->ip_address)
            ->where('login_status', 'success')
            ->orderBy('login_at', 'desc')
            ->first();

        return [
            'id' => $session->id,
            'device_type' => $session->device_type,
            'browser' => $session->browser,
            'operating_system' => $session->operating_system,
            'ip_address' => $session->ip_address,
            'last_activity' => $session->getLastActivityAsCarbon(),
            'time_ago' => $session->time_ago,
            'device_icon' => $session->device_icon,
            'is_current' => $session->isCurrentSession(),
            'user_agent' => $session->user_agent,
            'location' => $this->getLocationFromIP($session->ip_address),
            'full_user_agent' => $session->user_agent,
            'raw_last_activity' => $session->last_activity,
            'created_at' => $session->created_at ? \Carbon\Carbon::parse($session->created_at) : null,
            'login_at' => $recentLogin ? \Carbon\Carbon::parse($recentLogin->login_at) : null
        ];
    }

    /**
     * Revoke a specific session.
     */
    public function revokeSession(string $sessionId, int $userId): bool
    {
        $session = Session::where('id', $sessionId)
            ->where('user_id', $userId)
            ->first();

        if (!$session) {
            return false;
        }

        // Don't allow revoking current session
        if ($session->isCurrentSession()) {
            return false;
        }

        return $session->delete();
    }

    /**
     * Revoke all sessions except current session.
     */
    public function revokeAllOtherSessions(int $userId): int
    {
        $currentSessionId = session()->getId();
        
        $revokedCount = Session::where('user_id', $userId)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        return $revokedCount;
    }

    /**
     * Force revoke ALL sessions including current session (for security purposes).
     */
    public function forceRevokeAllSessions(int $userId): int
    {
        $revokedCount = Session::where('user_id', $userId)->delete();
        
        // Also invalidate the current session
        session()->invalidate();
        session()->regenerateToken();
        
        return $revokedCount;
    }

    /**
     * Get device statistics for a user.
     */
    public function getDeviceStats(int $userId): array
    {
        $sessions = Session::where('user_id', $userId)->get();
        
        $deviceTypes = $sessions->groupBy('device_type');
        $browsers = $sessions->groupBy('browser');
        $operatingSystems = $sessions->groupBy('operating_system');
        
        return [
            'total_sessions' => $sessions->count(),
            'active_sessions' => $sessions->where('last_activity', '>=', now()->subMinutes(30)->timestamp)->count(),
            'device_types' => $deviceTypes->map->count(),
            'browsers' => $browsers->map->count(),
            'operating_systems' => $operatingSystems->map->count(),
            'unique_ips' => $sessions->unique('ip_address')->count()
        ];
    }

    /**
     * Get location from IP address with accurate geolocation.
     * Returns format: [Province, Country] for better readability.
     */
    private function getLocationFromIP(string $ipAddress): string
    {
        // For local/private IPs - show development environment
        if (in_array($ipAddress, ['127.0.0.1', '::1', 'localhost']) || 
            preg_match('/^192\.168\./', $ipAddress) ||
            preg_match('/^10\./', $ipAddress) ||
            preg_match('/^172\.(1[6-9]|2[0-9]|3[0-1])\./', $ipAddress)) {
            return '[Jaringan Lokal, Indonesia]';
        }

        // Cache the location lookup for 24 hours
        return Cache::remember("location_ip_{$ipAddress}", 60 * 60 * 24, function () use ($ipAddress) {
            try {
                // Using ip-api.com service for accurate geolocation
                $response = @file_get_contents("http://ip-api.com/json/{$ipAddress}?fields=country,regionName,city,countryCode&lang=id");
                
                if ($response) {
                    $data = json_decode($response, true);
                    if ($data && isset($data['country']) && $data['country'] !== 'fail') {
                        
                        // For Indonesian IPs - prioritize regionName (province)
                        if ($data['countryCode'] === 'ID') {
                            $province = !empty($data['regionName']) ? $data['regionName'] : 
                                       (!empty($data['city']) ? $data['city'] : 'Tidak Diketahui');
                            return "[{$province}, Indonesia]";
                        } else {
                            // For international IPs
                            $region = !empty($data['regionName']) ? $data['regionName'] : 
                                     (!empty($data['city']) ? $data['city'] : 'Tidak Diketahui');
                            $country = $data['country'] ?? 'Tidak Diketahui';
                            return "[{$region}, {$country}]";
                        }
                    }
                }
            } catch (\Exception $e) {
                // Log error for debugging
                Log::warning("Geolocation API failed for IP {$ipAddress}: " . $e->getMessage());
            }
            
            return '[Lokasi Tidak Diketahui]';
        });
    }

    /**
     * Clean up old sessions (older than 30 days).
     */
    public function cleanupOldSessions(): int
    {
        $cutoff = now()->subDays(30)->timestamp;
        
        return Session::where('last_activity', '<', $cutoff)->delete();
    }

    /**
     * Get session summary for security overview.
     */
    public function getSessionSummary(int $userId): array
    {
        $activeSessions = $this->getActiveSessions($userId);
        $currentSession = $activeSessions->where('is_current', true)->first();
        
        return [
            'active_sessions_count' => $activeSessions->count(),
            'current_session' => $currentSession,
            'recent_sessions' => $activeSessions->take(3),
            'total_devices' => $activeSessions->unique('device_type')->count()
        ];
    }
}
