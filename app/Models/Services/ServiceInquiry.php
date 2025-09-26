<?php

namespace App\Models\Services;

use App\Models\Base\ServicesModel;

/**
 * Model ServiceInquiry untuk database Services (centrova_services)
 * 
 * Model ini mengakses tabel service_inquiries di database centrova_services
 * untuk menyimpan data konsultasi dan inquiry layanan
 */
class ServiceInquiry extends ServicesModel
{
    /**
     * The table associated with the model.
     */
    protected $table = 'service_inquiries';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'service_type', // 'web-development', 'mobile-app', etc
        'subject',
        'message',
        'budget_range',
        'timeline',
        'source', // 'website', 'whatsapp', 'social-media', etc
        'status', // 'new', 'contacted', 'quoted', 'converted', 'closed'
        'priority', // 'low', 'medium', 'high', 'urgent'
        'assigned_to', // staff ID yang handle inquiry ini
        'follow_up_date',
        'notes',
        'converted_to_order_id', // reference ke service_orders jika convert
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'follow_up_date' => 'datetime',
        'converted_to_order_id' => 'integer',
    ];

    /**
     * Scopes untuk filter berdasarkan status
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['new', 'contacted']);
    }

    public function scopeConverted($query)
    {
        return $query->where('status', 'converted');
    }

    /**
     * Scope untuk filter berdasarkan prioritas
     */
    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    /**
     * Scope untuk inquiry yang perlu follow up
     */
    public function scopeNeedFollowUp($query)
    {
        return $query->where('follow_up_date', '<=', now())
                    ->where('status', '!=', 'converted')
                    ->where('status', '!=', 'closed');
    }

    /**
     * Relationship dengan service order jika sudah convert
     */
    public function convertedOrder()
    {
        return $this->belongsTo(ServiceOrder::class, 'converted_to_order_id');
    }

    /**
     * Method untuk convert inquiry menjadi order
     */
    public function convertToOrder($orderData)
    {
        $order = ServiceOrder::create(array_merge($orderData, [
            'user_id' => null, // bisa diisi nanti jika user register
        ]));

        $this->update([
            'status' => 'converted',
            'converted_to_order_id' => $order->id,
        ]);

        return $order;
    }

    /**
     * Method untuk set follow up date
     */
    public function setFollowUp($date, $notes = null)
    {
        $this->update([
            'follow_up_date' => $date,
            'notes' => $notes ?: $this->notes,
        ]);
    }
}
