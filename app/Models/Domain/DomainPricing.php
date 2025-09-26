<?php

namespace App\Models\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DomainPricing extends Model
{
    protected $connection = 'account';
    protected $table = 'domain_pricing';
    
    protected $fillable = [
        'tld',
        'tld_display',
        'registration_price',
        'renewal_price',
        'transfer_price',
        'privacy_price',
        'min_years',
        'max_years',
        'is_available',
        'is_featured',
        'sort_order',
        'registrar',
        'features',
        'description'
    ];

    protected $casts = [
        'registration_price' => 'decimal:2',
        'renewal_price' => 'decimal:2',
        'transfer_price' => 'decimal:2',
        'privacy_price' => 'decimal:2',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'features' => 'array'
    ];

    /**
     * Get domains using this TLD
     */
    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class, 'tld', 'tld');
    }

    /**
     * Get formatted TLD display name
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->tld_display ?: strtoupper($this->tld);
    }

    /**
     * Get formatted registration price
     */
    public function getFormattedRegistrationPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->registration_price, 0, ',', '.');
    }

    /**
     * Get formatted renewal price
     */
    public function getFormattedRenewalPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->renewal_price, 0, ',', '.');
    }

    /**
     * Check if TLD has privacy protection
     */
    public function hasPrivacyProtection(): bool
    {
        return $this->privacy_price > 0;
    }

    /**
     * Scope for active TLDs
     */
    public function scopeActive($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope for popular TLDs (using is_featured as popular indicator)
     */
    public function scopePopular($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope ordered by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('tld');
    }

    /**
     * Get pricing for a specific TLD
     */
    public static function getPricingForTld(string $tld): ?self
    {
        return static::active()->where('tld', $tld)->first();
    }

    /**
     * Get popular TLDs for display
     */
    public static function getPopularTlds(): \Illuminate\Database\Eloquent\Collection
    {
        return static::active()->popular()->ordered()->get();
    }

    /**
     * Get all available TLDs
     */
    public static function getAvailableTlds(): \Illuminate\Database\Eloquent\Collection
    {
        return static::active()->ordered()->get();
    }
}
