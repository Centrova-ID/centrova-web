<?php

namespace App\Services;

use App\Models\Account\LoginAlert;
use App\Models\Account\UserLoginActivity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LoginAlertService
{
    /**
     * Create a new login alert
     */
    public function createAlert(
        int $userId, 
        string $alertType, 
        string $severity, 
        string $title, 
        string $message, 
        array $metadata = [],
        ?int $loginActivityId = null
    ): LoginAlert {
        return LoginAlert::create([
            'user_id' => $userId,
            'login_activity_id' => $loginActivityId,
            'alert_type' => $alertType,
            'severity' => $severity,
            'title' => $title,
            'message' => $message,
            'metadata' => $metadata,
            'alert_time' => now(),
            'status' => 'unread'
        ]);
    }

    /**
     * Get all login alerts for a user with pagination
     */
    public function getUserAlerts(int $userId, int $perPage = 20): Collection
    {
        $cacheKey = "login_alerts_user_{$userId}";
        
        return Cache::remember($cacheKey, 300, function () use ($userId, $perPage) {
            return LoginAlert::where('user_id', $userId)
                ->with('loginActivity')
                ->orderBy('alert_time', 'desc')
                ->limit($perPage)
                ->get();
        });
    }

    /**
     * Get unread alerts count for a user
     */
    public function getUnreadCount(int $userId): int
    {
        $cacheKey = "unread_alerts_count_{$userId}";
        
        return Cache::remember($cacheKey, 60, function () use ($userId) {
            return LoginAlert::where('user_id', $userId)
                ->where('status', 'unread')
                ->count();
        });
    }

    /**
     * Get alert statistics for dashboard
     */
    public function getAlertStats(int $userId): array
    {
        $cacheKey = "alert_stats_{$userId}";
        
        return Cache::remember($cacheKey, 600, function () use ($userId) {
            $stats = DB::connection('account')
                ->table('login_alerts')
                ->selectRaw('
                    COUNT(*) as total_alerts,
                    COUNT(CASE WHEN status = "unread" THEN 1 END) as unread_count,
                    COUNT(CASE WHEN severity = "critical" THEN 1 END) as critical_count,
                    COUNT(CASE WHEN severity = "high" THEN 1 END) as high_count,
                    COUNT(CASE WHEN alert_time >= ? THEN 1 END) as recent_count
                ')
                ->where('user_id', $userId)
                ->addBinding(now()->subDays(7)->toDateTimeString(), 'select')
                ->first();

            return [
                'total_alerts' => $stats->total_alerts ?? 0,
                'unread_count' => $stats->unread_count ?? 0,
                'critical_count' => $stats->critical_count ?? 0,
                'high_count' => $stats->high_count ?? 0,
                'recent_count' => $stats->recent_count ?? 0,
            ];
        });
    }

    /**
     * Process login activity and create alerts if needed
     */
    public function processLoginActivity(UserLoginActivity $loginActivity): void
    {
        $userId = $loginActivity->user_id;
        
        // Check for suspicious login patterns
        $this->checkSuspiciousLogin($loginActivity);
        
        // Check for new device login
        $this->checkNewDeviceLogin($loginActivity);
        
        // Check for failed login attempts
        $this->checkFailedLoginAttempts($loginActivity);
        
        // Clear cache
        $this->clearUserAlertCache($userId);
    }

    /**
     * Check for suspicious login patterns
     */
    private function checkSuspiciousLogin(UserLoginActivity $loginActivity): void
    {
        $userId = $loginActivity->user_id;
        $ipAddress = $loginActivity->ip_address;
        
        // Check if IP has had failed attempts recently
        $recentFailures = DB::connection('account')
            ->table('user_login_activities')
            ->where('user_id', $userId)
            ->where('ip_address', $ipAddress)
            ->where('login_status', 'failed')
            ->where('login_at', '>=', now()->subHours(6))
            ->count();

        if ($recentFailures >= 3) {
            $this->createAlert(
                $userId,
                'suspicious_login',
                'high',
                'Login Mencurigakan Terdeteksi',
                "Login berhasil dari IP {$ipAddress} setelah {$recentFailures} percobaan gagal dalam 6 jam terakhir.",
                [
                    'ip_address' => $loginActivity->ip_address,
                    'device_type' => $loginActivity->device_type,
                    'browser' => $loginActivity->browser,
                    'operating_system' => $loginActivity->operating_system,
                    'location' => $loginActivity->location,
                    'failed_attempts_count' => $recentFailures,
                    'user_agent' => $loginActivity->user_agent
                ],
                $loginActivity->id
            );
        }

        // Check for login from unusual location
        $this->checkUnusualLocation($loginActivity);
    }

    /**
     * Check for new device login
     */
    private function checkNewDeviceLogin(UserLoginActivity $loginActivity): void
    {
        if ($loginActivity->login_status !== 'success') {
            return;
        }

        $userId = $loginActivity->user_id;
        $userAgent = $loginActivity->user_agent;
        
        // Check if this user agent has been seen before
        $existingLogins = DB::connection('account')
            ->table('user_login_activities')
            ->where('user_id', $userId)
            ->where('user_agent', $userAgent)
            ->where('login_status', 'success')
            ->where('login_at', '<', $loginActivity->login_at)
            ->exists();

        if (!$existingLogins) {
            $this->createAlert(
                $userId,
                'new_login',
                'medium',
                'Login dari Perangkat Baru',
                "Login berhasil dari {$loginActivity->browser} di {$loginActivity->operating_system}",
                [
                    'ip_address' => $loginActivity->ip_address,
                    'device_type' => $loginActivity->device_type,
                    'browser' => $loginActivity->browser,
                    'operating_system' => $loginActivity->operating_system,
                    'location' => $loginActivity->location,
                    'user_agent' => $loginActivity->user_agent
                ],
                $loginActivity->id
            );
        }
    }

    /**
     * Check for failed login attempts
     */
    private function checkFailedLoginAttempts(UserLoginActivity $loginActivity): void
    {
        if ($loginActivity->login_status !== 'failed') {
            return;
        }

        $userId = $loginActivity->user_id;
        $ipAddress = $loginActivity->ip_address;
        
        // Count recent failed attempts from same IP
        $recentFailures = DB::connection('account')
            ->table('user_login_activities')
            ->where('user_id', $userId)
            ->where('ip_address', $ipAddress)
            ->where('login_status', 'failed')
            ->where('login_at', '>=', now()->subHours(1))
            ->count();

        // Create alert for multiple failed attempts
        if ($recentFailures >= 5) {
            $severity = $recentFailures >= 10 ? 'critical' : 'high';
            
            $this->createAlert(
                $userId,
                'failed_attempts',
                $severity,
                'Percobaan Login Gagal Berulang',
                "{$recentFailures} percobaan login gagal dari IP {$ipAddress} dalam 1 jam terakhir.",
                [
                    'ip_address' => $loginActivity->ip_address,
                    'device_type' => $loginActivity->device_type,
                    'browser' => $loginActivity->browser,
                    'operating_system' => $loginActivity->operating_system,
                    'location' => $loginActivity->location,
                    'failed_attempts_count' => $recentFailures,
                    'user_agent' => $loginActivity->user_agent
                ],
                $loginActivity->id
            );
        }
    }

    /**
     * Check for unusual location
     */
    private function checkUnusualLocation(UserLoginActivity $loginActivity): void
    {
        if ($loginActivity->login_status !== 'success' || !$loginActivity->country_code) {
            return;
        }

        $userId = $loginActivity->user_id;
        $countryCode = $loginActivity->country_code;
        
        // Check if user has logged in from this country before
        $existingFromCountry = DB::connection('account')
            ->table('user_login_activities')
            ->where('user_id', $userId)
            ->where('country_code', $countryCode)
            ->where('login_status', 'success')
            ->where('login_at', '<', $loginActivity->login_at)
            ->exists();

        if (!$existingFromCountry) {
            $this->createAlert(
                $userId,
                'suspicious_login',
                'medium',
                'Login dari Lokasi Baru',
                "Login berhasil dari {$loginActivity->location}",
                [
                    'ip_address' => $loginActivity->ip_address,
                    'device_type' => $loginActivity->device_type,
                    'browser' => $loginActivity->browser,
                    'operating_system' => $loginActivity->operating_system,
                    'location' => $loginActivity->location,
                    'country_code' => $loginActivity->country_code,
                    'user_agent' => $loginActivity->user_agent
                ],
                $loginActivity->id
            );
        }
    }

    /**
     * Mark alert as safe (mark as read and dismiss)
     */
    public function markAlertSafe(int $alertId, int $userId): bool
    {
        $alert = LoginAlert::where('id', $alertId)
            ->where('user_id', $userId)
            ->first();

        if (!$alert) {
            return false;
        }

        $result = $alert->update([
            'status' => 'dismissed',
            'read_at' => now(),
            'dismissed_at' => now()
        ]);

        if ($result) {
            $this->clearUserAlertCache($userId);
        }

        return $result;
    }

    /**
     * Report suspicious login
     */
    public function reportSuspiciousLogin(int $alertId, int $userId): bool
    {
        $alert = LoginAlert::where('id', $alertId)
            ->where('user_id', $userId)
            ->first();

        if (!$alert) {
            return false;
        }

        $result = $alert->reportAsSuspicious();

        if ($result) {
            // Log the suspicious report for admin review
            Log::warning('Suspicious login reported by user', [
                'user_id' => $userId,
                'alert_id' => $alertId,
                'alert_type' => $alert->alert_type,
                'metadata' => $alert->metadata
            ]);

            $this->clearUserAlertCache($userId);
        }

        return $result;
    }

    /**
     * Clear user alert cache
     */
    public function clearUserAlertCache(int $userId): void
    {
        Cache::forget("login_alerts_user_{$userId}");
        Cache::forget("unread_alerts_count_{$userId}");
        Cache::forget("alert_stats_{$userId}");
    }

    /**
     * Clean up old alerts (keep last 90 days)
     */
    public function cleanupOldAlerts(): int
    {
        $cutoffDate = now()->subDays(90);
        
        return DB::connection('account')
            ->table('login_alerts')
            ->where('alert_time', '<', $cutoffDate)
            ->where('status', '!=', 'reported') // Keep reported alerts longer
            ->delete();
    }
}
