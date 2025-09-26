<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain_name',
        'tld',
        'status',
        'registration_price',
        'renewal_price',
        'registration_date',
        'expiry_date',
        'next_due_date',
        'auto_renew',
        'registrar_domain_id',
        'auth_code',
        'nameservers',
        'contact_info',
        'notes',
        'last_sync_at'
    ];

    protected $casts = [
        'registration_date' => 'date',
        'expiry_date' => 'date',
        'next_due_date' => 'date',
        'auto_renew' => 'boolean',
        'nameservers' => 'json',
        'contact_info' => 'json',
        'last_sync_at' => 'datetime',
        'registration_price' => 'decimal:2',
        'renewal_price' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nameserverRecords()
    {
        return $this->hasMany(DomainNameserver::class);
    }

    public function orders()
    {
        return $this->hasMany(DomainOrder::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('expiry_date', '<=', Carbon::now()->addDays($days))
                    ->where('status', 'active');
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', Carbon::now())
                    ->where('status', '!=', 'expired');
    }

    // Accessors & Mutators
    public function getFullDomainAttribute()
    {
        return $this->domain_name . $this->tld;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'active' => 'bg-green-100 text-green-800',
            'expired' => 'bg-red-100 text-red-800',
            'suspended' => 'bg-gray-100 text-gray-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu Aktivasi',
            'active' => 'Aktif',
            'expired' => 'Kadaluarsa',
            'suspended' => 'Ditangguhkan',
            'cancelled' => 'Dibatalkan',
        ];

        return $texts[$this->status] ?? 'Status Tidak Diketahui';
    }

    public function getDaysUntilExpiryAttribute()
    {
        return $this->expiry_date ? Carbon::now()->diffInDays($this->expiry_date, false) : null;
    }

    public function getIsExpiringSoonAttribute()
    {
        return $this->days_until_expiry !== null && $this->days_until_expiry <= 30 && $this->days_until_expiry >= 0;
    }

    public function getIsExpiredAttribute()
    {
        return $this->days_until_expiry !== null && $this->days_until_expiry < 0;
    }

    // Helper Methods
    public function canBeRenewed()
    {
        return in_array($this->status, ['active', 'expired']) && $this->days_until_expiry < 90;
    }

    public function canUpdateNameservers()
    {
        return $this->status === 'active';
    }

    public function updateNameservers(array $nameservers)
    {
        // Remove existing nameservers
        $this->nameserverRecords()->delete();

        // Add new nameservers
        foreach ($nameservers as $index => $ns) {
            $this->nameserverRecords()->create([
                'nameserver' => $ns,
                'priority' => $index + 1,
                'is_active' => true
            ]);
        }

        // Update the JSON field as well
        $this->update(['nameservers' => $nameservers]);
    }
}