<?php

namespace App\Models\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Carbon\Carbon;

class Domain extends Model
{
    protected $connection = 'account';
    
    protected $fillable = [
        'domain_name',
        'user_id',
        'registrar_domain_id',
        'tld',
        'status',
        'registration_date',
        'expiry_date',
        'auto_renew',
        'registration_price',
        'renewal_price',
        'nameservers',
        'contact_info',
        'dns_records',
        'privacy_protection',
        'privacy_price',
        'registrar_status',
        'notes',
        'last_sync_at'
    ];

    protected $casts = [
        'registration_date' => 'date',
        'expiry_date' => 'date',
        'nameservers' => 'array',
        'contact_info' => 'array',
        'dns_records' => 'array',
        'auto_renew' => 'boolean',
        'privacy_protection' => 'boolean',
        'registration_price' => 'decimal:2',
        'renewal_price' => 'decimal:2',
        'privacy_price' => 'decimal:2',
        'last_sync_at' => 'datetime'
    ];

    /**
     * Get the user that owns the domain
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get domain notifications
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(DomainNotification::class);
    }

    /**
     * Get domain pricing info
     */
    public function pricing(): BelongsTo
    {
        return $this->belongsTo(DomainPricing::class, 'tld', 'tld');
    }

    /**
     * Check if domain is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if domain is expired
     */
    public function isExpired(): bool
    {
        return $this->status === 'expired' || $this->expiry_date->isPast();
    }

    /**
     * Check if domain is expiring soon (within 30 days)
     */
    public function isExpiringSoon(): bool
    {
        return $this->expiry_date->diffInDays(now()) <= 30 && !$this->isExpired();
    }

    /**
     * Get days until expiry
     */
    public function getDaysUntilExpiryAttribute(): int
    {
        if ($this->isExpired()) {
            return 0;
        }
        
        return $this->expiry_date->diffInDays(now());
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'active' => 'green',
            'pending' => 'yellow',
            'expired' => 'red',
            'cancelled' => 'gray',
            'transferred' => 'blue',
            default => 'gray'
        };
    }

    /**
     * Get formatted expiry date
     */
    public function getFormattedExpiryAttribute(): string
    {
        return $this->expiry_date->format('d M Y');
    }

    /**
     * Get default nameservers
     */
    public function getDefaultNameservers(): array
    {
        return [
            'ns1.centrova.com',
            'ns2.centrova.com'
        ];
    }

    /**
     * Scope for active domains
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for expiring domains
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('expiry_date', '<=', now()->addDays($days))
                    ->where('expiry_date', '>', now())
                    ->where('status', 'active');
    }

    /**
     * Scope for user domains
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
