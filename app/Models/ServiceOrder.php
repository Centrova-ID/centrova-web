<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_type',
        'service_name',
        'status',
        'total_amount',
        'payment_status',
        'started_at',
        'completed_at',
        'cancelled_at',
        'cancellation_reason',
        'description',
        'details'
    ];

    protected $casts = [
        'details' => 'json',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress', 'development']);
    }

    public function scopeCancellable($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress']);
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'in_progress']) && 
               $this->payment_status !== 'completed';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'development' => 'bg-purple-100 text-purple-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu Konfirmasi',
            'in_progress' => 'Sedang Dikerjakan',
            'development' => 'Dalam Pengembangan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $texts[$this->status] ?? 'Status Tidak Diketahui';
    }
}
