<?php

namespace App\Services;

use App\Models\Account\Session;
use App\Models\Account\UserLoginActivity;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class RealTimeDeviceService
{
    private Agent $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    /**
     * Get real-time device information for a user
     */
    public function getRealTimeDevices(User $user): array
    {
        $cacheKey = "realtime_devices_user_{$user->id}";
        
        return Cache::remember($cacheKey, 30, function () use ($user) { // Cache for 30 seconds for real-time data
            $sessions = $this->getActiveSessions($user->id);
            $devices = $this->processDevicesFromSessions($sessions);
            $stats = $this->calculateDeviceStats($sessions);
            
            return [
                'devices' => $devices,
                'stats' => $stats,
                'last_updated' => now()
            ];
        });
    }

    /**
     * Get active sessions from database
     */
    private function getActiveSessions(int $userId): Collection
    {
        return Session::where('user_id', $userId)
            ->where('last_activity', '>=', now()->subDays(30)->timestamp) // Active in last 30 days
            ->orderBy('last_activity', 'desc')
            ->get();
    }

    /**
     * Process sessions into device format
     */
    private function processDevicesFromSessions(Collection $sessions): Collection
    {
        return $sessions->map(function ($session) {
            $lastActivity = Carbon::createFromTimestamp($session->last_activity);
            $isCurrentlyActive = $lastActivity->gt(now()->subMinutes(30));
            
            // Return as object (stdClass) instead of array for compatibility with blade view
            return (object) [
                'id' => $session->id,
                'device_name' => $this->generateDeviceName($session),
                'device_type' => $this->parseDeviceType($session->user_agent),
                'browser' => $this->parseBrowser($session->user_agent),
                'operating_system' => $this->parseOperatingSystem($session->user_agent),
                'ip_address' => $session->ip_address,
                'location' => $this->getLocationFromIP($session->ip_address),
                'last_active_at' => $lastActivity,
                'is_current_session' => $session->id === session()->getId(),
                'is_currently_active' => $isCurrentlyActive,
                'session_duration' => $this->calculateSessionDuration($session),
                'security_level' => $this->assessDeviceSecurity($session),
                'first_seen' => $session->created_at ? Carbon::parse($session->created_at) : $lastActivity,
            ];
        });
    }

    /**
     * Generate device name from session data
     */
    private function generateDeviceName($session): string
    {
        $this->agent->setUserAgent($session->user_agent);
        
        $browser = $this->agent->browser();
        $platform = $this->agent->platform();
        
        if ($browser && $platform) {
            return "{$browser} di {$platform}";
        }
        
        return 'Perangkat Tidak Dikenal';
    }

    /**
     * Parse device type from user agent
     */
    private function parseDeviceType(string $userAgent): string
    {
        $this->agent->setUserAgent($userAgent);
        
        if ($this->agent->isTablet()) {
            return 'tablet';
        } elseif ($this->agent->isMobile()) {
            return 'mobile';
        } else {
            return 'desktop';
        }
    }

    /**
     * Parse browser from user agent
     */
    private function parseBrowser(string $userAgent): string
    {
        $this->agent->setUserAgent($userAgent);
        return $this->agent->browser() ?: 'Unknown';
    }

    /**
     * Parse operating system from user agent
     */
    private function parseOperatingSystem(string $userAgent): string
    {
        $this->agent->setUserAgent($userAgent);
        return $this->agent->platform() ?: 'Unknown';
    }

    /**
     * Get location from IP address
     */
    private function getLocationFromIP(string $ip): string
    {
        // For local/development IPs
        if (in_array($ip, ['127.0.0.1', '::1']) || 
            str_starts_with($ip, '192.168.') || 
            str_starts_with($ip, '10.') || 
            str_starts_with($ip, '172.')) {
            return 'Jaringan Lokal';
        }

        // In production, you would use a GeoIP service here
        // For now, return a placeholder
        return 'Jakarta, Indonesia'; // Default location
    }

    /**
     * Calculate session duration
     */
    private function calculateSessionDuration($session): string
    {
        $startTime = $session->created_at ? Carbon::parse($session->created_at) : Carbon::createFromTimestamp($session->last_activity)->subHours(1);
        $endTime = Carbon::createFromTimestamp($session->last_activity);
        
        $duration = $startTime->diffInMinutes($endTime);
        
        if ($duration < 60) {
            return "{$duration} menit";
        } elseif ($duration < 1440) {
            $hours = floor($duration / 60);
            return "{$hours} jam";
        } else {
            $days = floor($duration / 1440);
            return "{$days} hari";
        }
    }

    /**
     * Assess device security level
     */
    private function assessDeviceSecurity($session): string
    {
        $lastActivity = Carbon::createFromTimestamp($session->last_activity);
        $score = 0;

        // Recent activity (within 24 hours)
        if ($lastActivity->gt(now()->subDay())) {
            $score += 3;
        }

        // Known browser
        $this->agent->setUserAgent($session->user_agent);
        if (in_array($this->agent->browser(), ['Chrome', 'Firefox', 'Safari', 'Edge'])) {
            $score += 2;
        }

        // Known location (same IP used before)
        $previousLogins = UserLoginActivity::where('ip_address', $session->ip_address)
            ->where('login_status', 'success')
            ->count();
        
        if ($previousLogins > 1) {
            $score += 2;
        }

        if ($score >= 6) {
            return 'Aman';
        } elseif ($score >= 4) {
            return 'Cukup Aman';
        } else {
            return 'Perlu Verifikasi';
        }
    }

    /**
     * Calculate device statistics
     */
    private function calculateDeviceStats(Collection $sessions): array
    {
        $deviceTypes = $sessions->groupBy(function ($session) {
            return $this->parseDeviceType($session->user_agent);
        });

        $browsers = $sessions->groupBy(function ($session) {
            return $this->parseBrowser($session->user_agent);
        });

        $activeSessions = $sessions->filter(function ($session) {
            return Carbon::createFromTimestamp($session->last_activity)->gt(now()->subMinutes(30));
        });

        return [
            'total_devices' => $sessions->count(),
            'active_now' => $activeSessions->count(),
            'device_types' => $deviceTypes->map->count()->toArray(),
            'browsers' => $browsers->map->count()->toArray(),
            'unique_ips' => $sessions->unique('ip_address')->count(),
            'most_used_device' => $deviceTypes->sortByDesc->count()->keys()->first() ?? 'Unknown',
            'last_activity' => $sessions->max('last_activity') ? 
                Carbon::createFromTimestamp($sessions->max('last_activity')) : null,
        ];
    }

    /**
     * Get real-time login activities
     */
    public function getRealTimeLoginActivities(User $user, int $limit = 10): Collection
    {
        return UserLoginActivity::where('user_id', $user->id)
            ->orderBy('login_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($activity) {
                // Return as object (stdClass) instead of array for compatibility with blade view
                return (object) [
                    'id' => $activity->id,
                    'ip_address' => $activity->ip_address,
                    'device_type' => $activity->device_type,
                    'browser' => $activity->browser,
                    'operating_system' => $activity->operating_system,
                    'location' => $activity->location ?? $this->getLocationFromIP($activity->ip_address),
                    'login_status' => $activity->login_status,
                    'is_suspicious' => $activity->is_suspicious,
                    'login_at' => $activity->login_at,
                    'time_ago' => $activity->login_at->diffForHumans(),
                    'failure_reason' => $activity->failure_reason,
                ];
            });
    }

    /**
     * Clear cache for user
     */
    public function clearCache(int $userId): void
    {
        Cache::forget("realtime_devices_user_{$userId}");
    }

    /**
     * Update device last activity
     */
    public function updateDeviceActivity(int $userId, string $sessionId): void
    {
        // Update session last activity
        Session::where('id', $sessionId)
            ->where('user_id', $userId)
            ->update(['last_activity' => now()->timestamp]);

        // Clear cache to force refresh
        $this->clearCache($userId);
    }
}
