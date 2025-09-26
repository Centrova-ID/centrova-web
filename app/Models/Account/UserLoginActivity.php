<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLoginActivity extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     */
    protected $table = 'user_login_activities';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'device_type',
        'browser',
        'operating_system',
        'location',
        'country_code',
        'login_status',
        'failure_reason',
        'is_suspicious',
        'login_at'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_suspicious' => 'boolean',
        'login_at' => 'datetime'
    ];

    /**
     * Get the user that owns the login activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
            default => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z'
        };
    }

    /**
     * Get the location display text.
     */
    public function getLocationDisplayAttribute(): string
    {
        if ($this->location) {
            return $this->location;
        }
        
        if ($this->country_code) {
            return $this->country_code;
        }
        
        return 'Unknown Location';
    }

    /**
     * Get the status color for display.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->login_status) {
            'success' => $this->is_suspicious ? 'text-yellow-600' : 'text-green-600',
            'failed' => 'text-red-600',
            'suspicious' => 'text-orange-600',
            default => 'text-gray-600'
        };
    }

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->login_status) {
            'success' => $this->is_suspicious ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'suspicious' => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get the status text.
     */
    public function getStatusTextAttribute(): string
    {
        if ($this->login_status === 'success' && $this->is_suspicious) {
            return 'Sukses (Mencurigakan)';
        }
        
        return match ($this->login_status) {
            'success' => 'Sukses',
            'failed' => 'Gagal',
            'suspicious' => 'Mencurigakan',
            default => 'Unknown'
        };
    }
}
