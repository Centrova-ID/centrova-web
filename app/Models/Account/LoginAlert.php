<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class LoginAlert extends Model
{
    /**
     * The connection name for the model.
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     */
    protected $table = 'login_alerts';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'login_activity_id',
        'alert_type',
        'severity',
        'title',
        'message',
        'metadata',
        'status',
        'alert_time',
        'read_at',
        'dismissed_at'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'metadata' => 'array',
        'alert_time' => 'datetime',
        'read_at' => 'datetime',
        'dismissed_at' => 'datetime'
    ];

    /**
     * Get the user that owns the alert.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the login activity related to this alert.
     */
    public function loginActivity(): BelongsTo
    {
        return $this->belongsTo(UserLoginActivity::class, 'login_activity_id');
    }

    /**
     * Scope untuk alerts yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope untuk alerts berdasarkan severity
     */
    public function scopeBySeverity($query, $severity)
    {
        return $query->where('severity', $severity);
    }

    /**
     * Scope untuk alerts terbaru
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('alert_time', '>=', now()->subDays($days));
    }

    /**
     * Mark alert as read
     */
    public function markAsRead(): bool
    {
        if ($this->status === 'unread') {
            return $this->update([
                'status' => 'read',
                'read_at' => now()
            ]);
        }
        
        return true;
    }

    /**
     * Mark alert as dismissed
     */
    public function dismiss(): bool
    {
        return $this->update([
            'status' => 'dismissed',
            'dismissed_at' => now()
        ]);
    }

    /**
     * Report alert as suspicious
     */
    public function reportAsSuspicious(): bool
    {
        return $this->update([
            'status' => 'reported'
        ]);
    }

    /**
     * Get severity badge color
     */
    public function getSeverityBadgeColorAttribute(): string
    {
        return match($this->severity) {
            'low' => 'bg-blue-100 text-blue-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'high' => 'bg-orange-100 text-orange-800',
            'critical' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get alert type icon
     */
    public function getAlertTypeIconAttribute(): string
    {
        return match($this->alert_type) {
            'new_login' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'suspicious_login' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z',
            'failed_attempts' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
            default => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
        };
    }

    /**
     * Get time ago string
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->alert_time->diffForHumans();
    }

    /**
     * Check if alert is recent (within last 24 hours)
     */
    public function getIsRecentAttribute(): bool
    {
        return $this->alert_time->gt(now()->subDay());
    }

    /**
     * Get formatted metadata for display
     */
    public function getFormattedMetadataAttribute(): array
    {
        $metadata = $this->metadata ?? [];
        
        return [
            'ip_address' => $metadata['ip_address'] ?? 'Tidak diketahui',
            'device_type' => ucfirst($metadata['device_type'] ?? 'unknown'),
            'browser' => $metadata['browser'] ?? 'Tidak diketahui',
            'operating_system' => $metadata['operating_system'] ?? 'Tidak diketahui',
            'location' => $metadata['location'] ?? 'Lokasi tidak diketahui',
            'user_agent' => $metadata['user_agent'] ?? null
        ];
    }
}
