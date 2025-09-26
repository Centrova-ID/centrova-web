<?php

namespace App\Models\Services;

use App\Models\Base\ServicesModel;

/**
 * Model ServiceOrder untuk database Services (centrova_services)
 * 
 * Model ini mengakses tabel service_orders di database centrova_services
 * untuk menyimpan data pesanan layanan website
 */
class ServiceOrder extends ServicesModel
{
    /**
     * The table associated with the model.
     */
    protected $table = 'service_orders';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id', // reference ke users di database account
        'service_type', // 'web-development', 'mobile-app', etc
        'package_name', // 'Personal', 'Basic', 'Professional', 'Enterprise'
        'billing_type', // 'project', 'monthly'
        'status', // 'pending', 'in-progress', 'completed', 'cancelled'
        'price',
        'currency',
        'requirements', // JSON field untuk requirement detail
        'features', // JSON field untuk fitur yang dipilih
        'timeline', // JSON field untuk timeline project
        'payment_status', // 'pending', 'partial', 'paid', 'refunded'
        'notes',
        'started_at',
        'completed_at',
        'cancelled_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'requirements' => 'array',
        'features' => 'array',
        'timeline' => 'array',
        'price' => 'decimal:2',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Scopes untuk filter berdasarkan status
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in-progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Accessor untuk format harga
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Method untuk update status
     */
    public function updateStatus($status, $notes = null)
    {
        $this->update([
            'status' => $status,
            'notes' => $notes ?: $this->notes,
        ]);

        if ($status === 'in-progress' && !$this->started_at) {
            $this->update(['started_at' => now()]);
        }

        if ($status === 'completed' && !$this->completed_at) {
            $this->update(['completed_at' => now()]);
        }

        if ($status === 'cancelled' && !$this->cancelled_at) {
            $this->update(['cancelled_at' => now()]);
        }
    }
}
