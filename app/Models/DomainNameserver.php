<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainNameserver extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'nameserver',
        'ip_address',
        'priority',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    // Relationships
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('priority');
    }

    // Validation helper
    public static function isValidNameserver($nameserver)
    {
        // Basic nameserver validation
        return filter_var($nameserver, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME);
    }

    // Get nameserver with priority display
    public function getDisplayNameAttribute()
    {
        return "NS{$this->priority}: {$this->nameserver}";
    }
}