<?php

namespace App\Models\Account;

use App\Models\Base\AccountModel;

/**
 * Model MultiAccountSession untuk mengelola multiple login sessions
 */
class MultiAccountSession extends AccountModel
{
    /**
     * The table associated with the model.
     */
    protected $table = 'multi_account_sessions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'session_id',
        'user_id',
        'is_active',
        'last_activity',
        'ip_address',
        'user_agent',
        'session_data',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'last_activity' => 'datetime',
        'session_data' => 'array',
    ];

    /**
     * Relationship dengan user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk session aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk session tertentu
     */
    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    /**
     * Get all active accounts for a session
     */
    public static function getActiveAccountsForSession($sessionId)
    {
        return static::with('user')
            ->forSession($sessionId)
            ->orderBy('last_activity', 'desc')
            ->get();
    }

    /**
     * Get current active account for a session
     */
    public static function getCurrentActiveAccount($sessionId)
    {
        return static::with('user')
            ->forSession($sessionId)
            ->active()
            ->first();
    }

    /**
     * Switch active account for a session
     */
    public static function switchActiveAccount($sessionId, $userId)
    {
        // Deactivate all accounts for this session
        static::forSession($sessionId)->update(['is_active' => false]);
        
        // Activate the specified account
        return static::updateOrCreate(
            [
                'session_id' => $sessionId,
                'user_id' => $userId,
            ],
            [
                'is_active' => true,
                'last_activity' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]
        );
    }

    /**
     * Add new account to session
     */
    public static function addAccountToSession($sessionId, $userId, $makeActive = true)
    {
        if ($makeActive) {
            // Deactivate all other accounts for this session
            static::forSession($sessionId)->update(['is_active' => false]);
        }

        return static::updateOrCreate(
            [
                'session_id' => $sessionId,
                'user_id' => $userId,
            ],
            [
                'is_active' => $makeActive,
                'last_activity' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]
        );
    }

    /**
     * Remove account from session
     */
    public static function removeAccountFromSession($sessionId, $userId)
    {
        $removed = static::forSession($sessionId)
            ->where('user_id', $userId)
            ->delete();

        // If we removed the active account, make the most recent one active
        if ($removed) {
            $remainingAccounts = static::getActiveAccountsForSession($sessionId);
            if ($remainingAccounts->isNotEmpty() && !$remainingAccounts->where('is_active', true)->count()) {
                $mostRecent = $remainingAccounts->first();
                $mostRecent->update(['is_active' => true]);
            }
        }

        return $removed;
    }

    /**
     * Clean up expired sessions
     */
    public static function cleanupExpiredSessions($hoursOld = 24)
    {
        return static::where('last_activity', '<', now()->subHours($hoursOld))->delete();
    }
}
