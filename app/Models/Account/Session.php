<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Session extends Model
{
    /**
     * The connection name for the model.
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     */
    protected $table = 'sessions';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'last_activity' => 'integer'
    ];

    /**
     * Get the user that owns the session.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the last activity as a Carbon instance.
     */
    public function getLastActivityAsCarbon(): Carbon
    {
        return Carbon::createFromTimestamp($this->last_activity);
    }

    /**
     * Get the device type from user agent.
     */
    public function getDeviceTypeAttribute(): string
    {
        $userAgent = strtolower($this->user_agent);
        
        if (preg_match('/mobile|android|iphone|ipad|tablet/', $userAgent)) {
            if (preg_match('/ipad|tablet/', $userAgent)) {
                return 'tablet';
            }
            return 'mobile';
        }
        
        return 'desktop';
    }

    /**
     * Get the browser from user agent.
     */
    public function getBrowserAttribute(): string
    {
        $userAgent = $this->user_agent;
        
        if (preg_match('/Chrome/i', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/Edge/i', $userAgent)) {
            return 'Edge';
        } elseif (preg_match('/Opera/i', $userAgent)) {
            return 'Opera';
        }
        
        return 'Unknown';
    }

    /**
     * Get the operating system from user agent.
     */
    public function getOperatingSystemAttribute(): string
    {
        $userAgent = $this->user_agent;
        
        if (preg_match('/Windows NT/i', $userAgent)) {
            return 'Windows';
        } elseif (preg_match('/Mac OS X/i', $userAgent)) {
            return 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            return 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            return 'Android';
        } elseif (preg_match('/iOS|iPhone|iPad/i', $userAgent)) {
            return 'iOS';
        }
        
        return 'Unknown';
    }

    /**
     * Get the device icon based on device type.
     */
    public function getDeviceIconAttribute(): string
    {
        return match ($this->device_type) {
            'mobile' => 'M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2M7 4a1 1 0 011-1h8a1 1 0 011 1v16a1 1 0 01-1 1H8a1 1 0 01-1-1V4z',
            'tablet' => 'M7 4a1 1 0 011-1h8a1 1 0 011 1v16a1 1 0 01-1 1H8a1 1 0 01-1-1V4zM5 4h2M5 20h2M19 4h2M19 20h2',
            'desktop' => 'M3 4h18v10H3V4zM8 18h8M12 14v4',
            default => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 002 2v10a2 2 0 002 2zM9 9h6v6H9V9z'
        };
    }

    /**
     * Check if this session is the current session.
     */
    public function isCurrentSession(): bool
    {
        return $this->id === session()->getId();
    }

    /**
     * Scope for active sessions (within last 30 minutes).
     */
    public function scopeActive($query)
    {
        return $query->where('last_activity', '>=', now()->subMinutes(30)->timestamp);
    }

    /**
     * Get time ago in a readable format.
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->getLastActivityAsCarbon()->diffForHumans();
    }
}
