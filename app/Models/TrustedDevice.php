<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class TrustedDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_fingerprint',
        'device_name',
        'device_type',
        'browser',
        'os',
        'ip_address',
        'user_agent',
        'last_used_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool
    {
        return $this->is_active && $this->expires_at->isFuture();
    }

    public function updateLastUsed(): void
    {
        $this->last_used_at = now();
        $this->save();
    }

    public function revoke(): void
    {
        $this->is_active = false;
        $this->save();
    }

    public static function generateFingerprint($request): string
    {
        $data = [
            'user_agent' => $request->header('User-Agent'),
            'accept_language' => $request->header('Accept-Language'),
            'accept_encoding' => $request->header('Accept-Encoding'),
            'ip' => $request->ip(),
            'session_id' => $request->session()->getId(),
            'sec_ch_ua' => $request->header('Sec-CH-UA') ?? '',
            'sec_ch_ua_platform' => $request->header('Sec-CH-UA-Platform') ?? '',
            'dnt' => $request->header('DNT') ?? '',
            'cache_control' => $request->header('Cache-Control') ?? '',
        ];

        return hash('sha256', serialize($data));
    }

    public static function parseUserAgent(string $userAgent): array
    {
        $deviceType = 'desktop';
        $browser = 'Unknown';
        $os = 'Unknown';

        if (preg_match('/Mobile|Android|iPhone|iPad|iPod|BlackBerry|Opera Mini/i', $userAgent)) {
            $deviceType = 'mobile';
        } elseif (preg_match('/Tablet|iPad/i', $userAgent)) {
            $deviceType = 'tablet';
        }

        if (preg_match('/Chrome\/([0-9.]+)/i', $userAgent, $matches)) {
            $browser = 'Chrome ' . $matches[1];
        } elseif (preg_match('/Firefox\/([0-9.]+)/i', $userAgent, $matches)) {
            $browser = 'Firefox ' . $matches[1];
        } elseif (preg_match('/Safari\/([0-9.]+)/i', $userAgent, $matches)) {
            $browser = 'Safari ' . $matches[1];
        } elseif (preg_match('/Edge\/([0-9.]+)/i', $userAgent, $matches)) {
            $browser = 'Edge ' . $matches[1];
        }

        if (preg_match('/Windows NT ([0-9.]+)/i', $userAgent, $matches)) {
            $os = 'Windows ' . $matches[1];
        } elseif (preg_match('/Mac OS X ([0-9_]+)/i', $userAgent, $matches)) {
            $os = 'macOS ' . str_replace('_', '.', $matches[1]);
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $os = 'Linux';
        } elseif (preg_match('/Android ([0-9.]+)/i', $userAgent, $matches)) {
            $os = 'Android ' . $matches[1];
        } elseif (preg_match('/iPhone OS ([0-9_]+)/i', $userAgent, $matches)) {
            $os = 'iOS ' . str_replace('_', '.', $matches[1]);
        }

        return [
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
        ];
    }

    public static function isTrusted(int $userId, string $deviceFingerprint): bool
    {
        return static::where('user_id', $userId)
            ->where('device_fingerprint', $deviceFingerprint)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->exists();
    }

    public static function cleanupExpired(): int
    {
        return static::where('expires_at', '<', now())->delete();
    }
};