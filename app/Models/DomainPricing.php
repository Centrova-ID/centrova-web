<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainPricing extends Model
{
    use HasFactory;

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'domain_pricing';

    protected $fillable = [
        'tld',
        'registration_price',
        'renewal_price',
        'transfer_price',
        'cost_price',
        'min_years',
        'max_years',
        'is_available',
        'is_featured',
        'sort_order',
        'description',
        'features'
    ];

    protected $casts = [
        'registration_price' => 'decimal:2',
        'renewal_price' => 'decimal:2',
        'transfer_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'min_years' => 'integer',
        'max_years' => 'integer',
        'sort_order' => 'integer',
        'features' => 'json',
    ];

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('registration_price');
    }

    public function scopePopular($query)
    {
        return $query->whereIn('tld', ['.com', '.id', '.net', '.org', '.co.id', '.web.id']);
    }

    // Accessors
    public function getFormattedRegistrationPriceAttribute()
    {
        return 'Rp ' . number_format($this->registration_price, 0, ',', '.');
    }

    public function getFormattedRenewalPriceAttribute()
    {
        return 'Rp ' . number_format($this->renewal_price, 0, ',', '.');
    }

    public function getFormattedTransferPriceAttribute()
    {
        return 'Rp ' . number_format($this->transfer_price, 0, ',', '.');
    }

    public function getProfitMarginAttribute()
    {
        if ($this->cost_price > 0) {
            return (($this->registration_price - $this->cost_price) / $this->cost_price) * 100;
        }
        return 0;
    }

    public function getDisplayTldAttribute()
    {
        return $this->tld;
    }

    public function getYearRangeTextAttribute()
    {
        if ($this->min_years === $this->max_years) {
            return $this->min_years . ' tahun';
        }
        return $this->min_years . '-' . $this->max_years . ' tahun';
    }

    // Helper methods
    public function calculatePrice($years = 1, $type = 'registration')
    {
        $years = max($this->min_years, min($this->max_years, $years));
        
        switch ($type) {
            case 'renewal':
                return $this->renewal_price * $years;
            case 'transfer':
                return $this->transfer_price * $years;
            default:
                return $this->registration_price * $years;
        }
    }

    public function getAvailableYears()
    {
        return range($this->min_years, $this->max_years);
    }

    // Get all available TLDs for dropdown
    public static function getAvailableTlds()
    {
        return self::available()->ordered()->pluck('tld', 'tld');
    }

    // Get featured TLDs for homepage
    public static function getFeaturedTlds()
    {
        return self::featured()->available()->ordered()->get();
    }

    // Get pricing for a specific TLD
    public static function getPricing($tld)
    {
        return self::where('tld', $tld)->available()->first();
    }
}