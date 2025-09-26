<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoFactorAuthLog extends Model
{
    use HasFactory;

    protected $table = 'two_factor_auth_logs';

    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'user_agent',
        'metadata',
        'created_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * Get the user that owns the log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log 2FA action
     */
    public static function logAction(int $userId, string $action, array $metadata = []): void
    {
        static::create([
            'user_id' => $userId,
            'action' => $action,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'metadata' => $metadata,
            'created_at' => now(),
        ]);
    }

    /**
     * Get recent logs for user
     */
    public static function getRecentLogs(int $userId, int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get failed attempts count in time window
     */
    public static function getFailedAttemptsCount(int $userId, int $minutes = 60): int
    {
        return static::where('user_id', $userId)
            ->where('action', 'pin_failed')
            ->where('created_at', '>=', now()->subMinutes($minutes))
            ->count();
    }
}
