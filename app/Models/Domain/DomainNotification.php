<?php

namespace App\Models\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class DomainNotification extends Model
{
    protected $connection = 'account';
    
    protected $fillable = [
        'domain_id',
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'email_sent',
        'scheduled_at',
        'sent_at'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'email_sent' => 'boolean',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime'
    ];

    /**
     * Get the domain this notification belongs to
     */
    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    /**
     * Get the user this notification belongs to
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(): void
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Mark notification as sent
     */
    public function markAsSent(): void
    {
        $this->update([
            'email_sent' => true,
            'sent_at' => now()
        ]);
    }

    /**
     * Get notification icon based on type
     */
    public function getIconAttribute(): string
    {
        return match($this->type) {
            'expiry_reminder' => 'clock',
            'renewal_success' => 'check-circle',
            'renewal_failed' => 'x-circle',
            'dns_updated' => 'globe',
            'transfer_initiated' => 'arrow-right',
            default => 'bell'
        };
    }

    /**
     * Get notification color based on type
     */
    public function getColorAttribute(): string
    {
        return match($this->type) {
            'expiry_reminder' => 'yellow',
            'renewal_success' => 'green',
            'renewal_failed' => 'red',
            'dns_updated' => 'blue',
            'transfer_initiated' => 'purple',
            default => 'gray'
        };
    }

    /**
     * Scope for unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for user notifications
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for scheduled notifications
     */
    public function scopeScheduled($query)
    {
        return $query->whereNotNull('scheduled_at')
                    ->where('scheduled_at', '<=', now())
                    ->where('email_sent', false);
    }

    /**
     * Create expiry reminder notification
     */
    public static function createExpiryReminder(Domain $domain, int $daysUntilExpiry): self
    {
        return static::create([
            'domain_id' => $domain->id,
            'user_id' => $domain->user_id,
            'type' => 'expiry_reminder',
            'title' => "Domain {$domain->domain_name} akan expired",
            'message' => "Domain {$domain->domain_name} akan expired dalam {$daysUntilExpiry} hari. Perpanjang sekarang untuk menghindari gangguan layanan.",
            'data' => [
                'domain_name' => $domain->domain_name,
                'expiry_date' => $domain->expiry_date->format('Y-m-d'),
                'days_until_expiry' => $daysUntilExpiry
            ]
        ]);
    }
}
