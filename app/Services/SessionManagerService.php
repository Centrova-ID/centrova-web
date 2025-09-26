<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SessionManagerService
{
    /**
     * Get all active sessions for a user.
     */
    public function getActiveSessions(int $userId): array
    {
        $sessions = DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->orderBy('last_activity', 'desc')
            ->get();

        $activeSessions = [];
        $currentSessionId = Session::getId();

        foreach ($sessions as $session) {
            $payload = $this->decodeSessionPayload($session->payload);
            
            $activeSessions[] = [
                'id' => $session->id,
                'ip_address' => $session->ip_address,
                'user_agent' => $session->user_agent,
                'last_activity' => $session->last_activity,
                'is_current' => $session->id === $currentSessionId,
                'device_info' => $this->parseUserAgent($session->user_agent),
                'location' => $this->getLocationFromIP($session->ip_address),
                'created_at' => $payload['created_at'] ?? null,
            ];
        }

        return $activeSessions;
    }

    /**
     * Revoke all other sessions for a user except current.
     */
    public function revokeOtherSessions(int $userId): int
    {
        $currentSessionId = Session::getId();
        
        $deletedCount = DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        return $deletedCount;
    }

    /**
     * Revoke all sessions for a user.
     */
    public function revokeAllSessions(int $userId): int
    {
        return DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->delete();
    }

    /**
     * Revoke a specific session.
     */
    public function revokeSession(string $sessionId): bool
    {
        return DB::connection('account')->table('sessions')
            ->where('id', $sessionId)
            ->delete() > 0;
    }

    /**
     * Get session count for a user.
     */
    public function getSessionCount(int $userId): int
    {
        return DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->count();
    }

    /**
     * Parse user agent string to get device info.
     */
    private function parseUserAgent(string $userAgent): array
    {
        $agent = new \Jenssegers\Agent\Agent();
        $agent->setUserAgent($userAgent);

        return [
            'device' => $agent->device() ?: 'Unknown',
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'is_desktop' => $agent->isDesktop(),
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
        ];
    }

    /**
     * Get location from IP address.
     */
    private function getLocationFromIP(string $ip): string
    {
        // For local development
        if ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return 'Local Network';
        }

        // In production, you would use a real GeoIP service
        return 'Unknown Location';
    }

    /**
     * Decode Laravel session payload.
     */
    private function decodeSessionPayload(string $payload): array
    {
        try {
            return unserialize(base64_decode($payload)) ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Check for suspicious session patterns.
     */
    public function detectSuspiciousSessions(int $userId): array
    {
        $sessions = $this->getActiveSessions($userId);
        $suspicious = [];

        // Check for multiple sessions from different locations
        $locations = array_unique(array_column($sessions, 'location'));
        if (count($locations) > 2) {
            $suspicious[] = [
                'type' => 'multiple_locations',
                'message' => 'Multiple login locations detected',
                'severity' => 'medium'
            ];
        }

        // Check for sessions from different countries (in real implementation)
        $ipAddresses = array_unique(array_column($sessions, 'ip_address'));
        if (count($ipAddresses) > 3) {
            $suspicious[] = [
                'type' => 'multiple_ips',
                'message' => 'Multiple IP addresses detected',
                'severity' => 'low'
            ];
        }

        // Check for old sessions that are still active
        $oldSessions = array_filter($sessions, function($session) {
            return $session['last_activity'] < (time() - 86400 * 7); // 7 days old
        });

        if (count($oldSessions) > 0) {
            $suspicious[] = [
                'type' => 'old_sessions',
                'message' => 'Old sessions still active',
                'severity' => 'low'
            ];
        }

        return $suspicious;
    }
}
