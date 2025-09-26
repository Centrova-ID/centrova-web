<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Account\UserLoginActivity;
use Carbon\Carbon;

class SecurityNotificationService
{
    /**
     * Check and notify suspicious activity
     */
    public function checkAndNotifySuspiciousActivity($userId, $loginActivity = null)
    {
        $notifications = [];
        
        if ($loginActivity) {
            // Check for new device
            if ($this->isNewDevice($userId, $loginActivity)) {
                $notifications[] = $this->createNotification($userId, [
                    'type' => 'new_device',
                    'title' => 'Login dari Perangkat Baru',
                    'message' => sprintf(
                        'Login dari perangkat baru: %s dengan %s pada %s',
                        $loginActivity->device_type,
                        $loginActivity->browser,
                        $loginActivity->login_at->format('d/m/Y H:i')
                    ),
                    'severity' => 'low',
                    'data' => [
                        'device_type' => $loginActivity->device_type,
                        'browser' => $loginActivity->browser,
                        'operating_system' => $loginActivity->operating_system,
                        'location' => $loginActivity->location ?? 'Unknown',
                        'ip_address' => $loginActivity->ip_address
                    ]
                ]);
            }
        }

        // Check for failed login attempts
        $failedAttempts = $this->getRecentFailedAttempts($userId);
        if ($failedAttempts > 3) {
            $notifications[] = $this->createNotification($userId, [
                'type' => 'failed_attempts',
                'title' => 'Percobaan Login Berulang Gagal',
                'message' => "Terdapat {$failedAttempts} percobaan login gagal dalam 24 jam terakhir",
                'severity' => 'high',
                'data' => [
                    'failed_attempts' => $failedAttempts,
                    'timeframe' => '24 hours'
                ]
            ]);
        }

        return $notifications;
    }

    /**
     * Create a notification
     */
    public function createNotification($userId, $data)
    {
        $notificationId = uniqid('notif_');
        
        $notification = [
            'id' => $notificationId,
            'user_id' => $userId,
            'type' => $data['type'],
            'title' => $data['title'],
            'message' => $data['message'],
            'severity' => $data['severity'] ?? 'low',
            'data' => $data['data'] ?? [],
            'timestamp' => now()->toISOString(),
            'time' => now()->diffForHumans(),
            'read' => false,
            'created_at' => now()
        ];

        // Store in cache
        $cacheKey = "security_notifications_user_{$userId}";
        $existingNotifications = Cache::get($cacheKey, []);
        
        // Add new notification to the beginning
        array_unshift($existingNotifications, $notification);
        
        // Keep only last 50 notifications
        $existingNotifications = array_slice($existingNotifications, 0, 50);
        
        // Store back in cache for 7 days
        Cache::put($cacheKey, $existingNotifications, now()->addDays(7));

        Log::info('Security notification created', $notification);

        return $notification;
    }

    /**
     * Get notifications for a user
     */
    public function getNotifications($userId, $limit = null)
    {
        $cacheKey = "security_notifications_user_{$userId}";
        $notifications = Cache::get($cacheKey, []);
        
        // Update relative times
        foreach ($notifications as &$notification) {
            if (isset($notification['timestamp'])) {
                $timestamp = Carbon::parse($notification['timestamp']);
                $notification['time'] = $timestamp->diffForHumans();
            }
        }
        
        return $limit ? array_slice($notifications, 0, $limit) : $notifications;
    }

    /**
     * Delete a notification
     */
    public function deleteNotification($userId, $notificationId)
    {
        $cacheKey = "security_notifications_user_{$userId}";
        $notifications = Cache::get($cacheKey, []);
        
        $notifications = array_filter($notifications, function($notification) use ($notificationId) {
            return $notification['id'] !== $notificationId;
        });
        
        Cache::put($cacheKey, array_values($notifications), now()->addDays(7));
        
        return true;
    }

    /**
     * Clear all notifications for a user
     */
    public function clearNotifications($userId)
    {
        $cacheKey = "security_notifications_user_{$userId}";
        Cache::forget($cacheKey);
        
        return true;
    }

    /**
     * Check if login is from a new device
     */
    private function isNewDevice($userId, $loginActivity)
    {
        $recentDevices = UserLoginActivity::where('user_id', $userId)
            ->where('login_status', 'success')
            ->where('login_at', '>=', now()->subDays(30))
            ->where('id', '!=', $loginActivity->id)
            ->get();

        $currentFingerprint = $this->generateDeviceFingerprint($loginActivity);
        
        foreach ($recentDevices as $device) {
            $deviceFingerprint = $this->generateDeviceFingerprint($device);
            if ($deviceFingerprint === $currentFingerprint) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get recent failed attempts count
     */
    private function getRecentFailedAttempts($userId)
    {
        return UserLoginActivity::where('user_id', $userId)
            ->where('login_status', 'failed')
            ->where('login_at', '>=', now()->subDay())
            ->count();
    }

    /**
     * Generate device fingerprint
     */
    private function generateDeviceFingerprint($loginActivity)
    {
        return hash('sha256', sprintf(
            '%s_%s_%s',
            $loginActivity->browser ?? 'unknown',
            $loginActivity->operating_system ?? 'unknown',
            $loginActivity->device_type ?? 'unknown'
        ));
    }
}
