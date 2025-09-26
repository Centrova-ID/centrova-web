<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FailedLoginAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'type',
        'ip_address',
        'user_agent',
        'mode',
        'attempt_data'
    ];

    protected $casts = [
        'attempt_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Record a failed login attempt
     */
    public static function recordAttempt(Request $request, string $identifier, string $type, string $mode, array $additionalData = [])
    {
        return static::create([
            'identifier' => $identifier,
            'type' => $type,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'mode' => $mode,
            'attempt_data' => array_merge([
                'timestamp' => now()->toISOString(),
                'session_id' => $request->session()->getId(),
            ], $additionalData)
        ]);
    }

    /**
     * Get failed attempts count for identifier within time window
     */
    public static function getAttemptsCount(string $identifier, string $type, int $withinMinutes = 60): int
    {
        return static::where('identifier', $identifier)
            ->where('type', $type)
            ->where('created_at', '>=', now()->subMinutes($withinMinutes))
            ->count();
    }

    /**
     * Get failed attempts count for IP within time window
     */
    public static function getIpAttemptsCount(string $ipAddress, int $withinMinutes = 60): int
    {
        return static::where('ip_address', $ipAddress)
            ->where('created_at', '>=', now()->subMinutes($withinMinutes))
            ->count();
    }

    /**
     * Check if identifier is locked (exceeded max attempts)
     */
    public static function isLocked(string $identifier, string $type, int $maxAttempts = 5, int $withinMinutes = 60): bool
    {
        $attempts = static::getAttemptsCount($identifier, $type, $withinMinutes);
        return $attempts >= $maxAttempts;
    }

    /**
     * Check if IP is locked (exceeded max attempts)
     */
    public static function isIpLocked(string $ipAddress, int $maxAttempts = 10, int $withinMinutes = 60): bool
    {
        $attempts = static::getIpAttemptsCount($ipAddress, $withinMinutes);
        return $attempts >= $maxAttempts;
    }

    /**
     * Get time until unlock for identifier
     */
    public static function getUnlockTime(string $identifier, string $type, int $withinMinutes = 60): ?Carbon
    {
        $latestAttempt = static::where('identifier', $identifier)
            ->where('type', $type)
            ->where('created_at', '>=', now()->subMinutes($withinMinutes))
            ->latest()
            ->first();

        if (!$latestAttempt) {
            return null;
        }

        return $latestAttempt->created_at->addMinutes($withinMinutes);
    }

    /**
     * Get time until unlock for IP
     */
    public static function getIpUnlockTime(string $ipAddress, int $withinMinutes = 60): ?Carbon
    {
        $latestAttempt = static::where('ip_address', $ipAddress)
            ->where('created_at', '>=', now()->subMinutes($withinMinutes))
            ->latest()
            ->first();

        if (!$latestAttempt) {
            return null;
        }

        return $latestAttempt->created_at->addMinutes($withinMinutes);
    }

    /**
     * Clear attempts for identifier (when login successful)
     */
    public static function clearAttempts(string $identifier, string $type)
    {
        return static::where('identifier', $identifier)
            ->where('type', $type)
            ->delete();
    }

    /**
     * Clean up old attempts (older than specified days)
     */
    public static function cleanupOldAttempts(int $olderThanDays = 30)
    {
        return static::where('created_at', '<', now()->subDays($olderThanDays))
            ->delete();
    }

    /**
     * Get attempts for analysis/debugging
     */
    public static function getRecentAttempts(string $identifier, string $type, int $limit = 10)
    {
        return static::where('identifier', $identifier)
            ->where('type', $type)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Check if should show lockout message
     */
    public static function shouldShowLockout(string $identifier, string $type, string $ipAddress, int $maxAttempts = 5): array
    {
        $identifierLocked = static::isLocked($identifier, $type, $maxAttempts);
        $ipLocked = static::isIpLocked($ipAddress, $maxAttempts * 2); // IP gets higher threshold
        
        if ($identifierLocked || $ipLocked) {
            $unlockTime = $identifierLocked 
                ? static::getUnlockTime($identifier, $type)
                : static::getIpUnlockTime($ipAddress);
                
            return [
                'locked' => true,
                'unlock_time' => $unlockTime,
                'attempts_count' => $identifierLocked 
                    ? static::getAttemptsCount($identifier, $type)
                    : static::getIpAttemptsCount($ipAddress),
                'reason' => $identifierLocked ? 'identifier' : 'ip'
            ];
        }

        return ['locked' => false];
    }
}
