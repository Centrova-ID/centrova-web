<?php

namespace App\Services;

use App\Models\Account\UserLoginActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class LoginActivityService
{
    protected Agent $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    /**
     * Log a login activity.
     */
    public function logActivity(
        int $userId,
        Request $request,
        string $status = 'success',
        ?string $failureReason = null,
        bool $isSuspicious = false
    ): UserLoginActivity {
        $userAgent = $request->userAgent() ?? '';
        $this->agent->setUserAgent($userAgent);

        $deviceType = $this->getDeviceType();
        $browser = $this->agent->browser();
        $platform = $this->agent->platform();
        $location = $this->getLocation($request->ip());

        return UserLoginActivity::create([
            'user_id' => $userId,
            'ip_address' => $request->ip(),
            'user_agent' => $userAgent,
            'device_type' => $deviceType,
            'browser' => $browser,
            'operating_system' => $platform,
            'location' => $location['location'] ?? null,
            'country_code' => $location['country_code'] ?? null,
            'login_status' => $status,
            'failure_reason' => $failureReason,
            'is_suspicious' => $isSuspicious,
            'login_at' => now('Asia/Jakarta')
        ]);
    }

    /**
     * Get recent login activities for a user.
     */
    public function getRecentActivities(int $userId, int $limit = 20): \Illuminate\Database\Eloquent\Collection
    {
        return UserLoginActivity::where('user_id', $userId)
            ->orderBy('login_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get suspicious activities for a user.
     */
    public function getSuspiciousActivities(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return UserLoginActivity::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('is_suspicious', true)
                      ->orWhere('login_status', 'suspicious')
                      ->orWhere('login_status', 'failed');
            })
            ->orderBy('login_at', 'desc')
            ->get();
    }

    /**
     * Check if login is suspicious based on various factors.
     */
    public function isSuspiciousLogin(int $userId, Request $request): bool
    {
        $currentIp = $request->ip();
        $userAgent = $request->userAgent();

        // Check for recent activities from different locations
        $recentActivities = UserLoginActivity::where('user_id', $userId)
            ->where('login_status', 'success')
            ->where('login_at', '>=', now()->subDays(7))
            ->get();

        // If this is the first login, not suspicious
        if ($recentActivities->isEmpty()) {
            return false;
        }

        // Check for new IP address
        $knownIps = $recentActivities->pluck('ip_address')->unique();
        if (!$knownIps->contains($currentIp)) {
            // New IP - check if from different country
            $currentLocation = $this->getLocation($currentIp);
            $knownCountries = $recentActivities->pluck('country_code')->unique()->filter();
            
            if (!empty($currentLocation['country_code']) && 
                !$knownCountries->isEmpty() && 
                !$knownCountries->contains($currentLocation['country_code'])) {
                return true;
            }
        }

        // Check for unusual user agent
        $knownUserAgents = $recentActivities->pluck('user_agent')->unique();
        if (!$knownUserAgents->contains($userAgent)) {
            // Different browser/device - might be suspicious
            $this->agent->setUserAgent($userAgent);
            $currentDeviceType = $this->getDeviceType();
            $knownDeviceTypes = $recentActivities->pluck('device_type')->unique();
            
            if (!$knownDeviceTypes->contains($currentDeviceType)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get device type from user agent.
     */
    protected function getDeviceType(): string
    {
        if ($this->agent->isPhone()) {
            return 'mobile';
        } elseif ($this->agent->isTablet()) {
            return 'tablet';
        } elseif ($this->agent->isDesktop()) {
            return 'desktop';
        }

        return 'unknown';
    }

    /**
     * Get location information from IP address.
     * Note: This is a simple implementation. In production, you might want to use a service like GeoIP.
     */
    protected function getLocation(string $ip): array
    {
        // For local IPs, return default
        if ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return [
                'location' => 'Local Network',
                'country_code' => 'LO'
            ];
        }

        // In a real application, you would use a GeoIP service here
        // For now, return a placeholder
        return [
            'location' => 'Unknown Location',
            'country_code' => null
        ];
    }

    /**
     * Clean old login activities (keep only last 90 days).
     */
    public function cleanOldActivities(): int
    {
        return UserLoginActivity::where('login_at', '<', now()->subDays(90))->delete();
    }

    /**
     * Get login statistics for a user.
     */
    public function getLoginStats(int $userId): array
    {
        $totalLogins = UserLoginActivity::where('user_id', $userId)->count();
        $successfulLogins = UserLoginActivity::where('user_id', $userId)->where('login_status', 'success')->count();
        $failedLogins = UserLoginActivity::where('user_id', $userId)->where('login_status', 'failed')->count();
        $suspiciousLogins = UserLoginActivity::where('user_id', $userId)->where('is_suspicious', true)->count();

        $lastLogin = UserLoginActivity::where('user_id', $userId)
            ->where('login_status', 'success')
            ->orderBy('login_at', 'desc')
            ->first();

        return [
            'total_logins' => $totalLogins,
            'successful_logins' => $successfulLogins,
            'failed_logins' => $failedLogins,
            'suspicious_logins' => $suspiciousLogins,
            'last_login' => $lastLogin?->login_at,
            'success_rate' => $totalLogins > 0 ? round(($successfulLogins / $totalLogins) * 100, 1) : 0
        ];
    }
}
