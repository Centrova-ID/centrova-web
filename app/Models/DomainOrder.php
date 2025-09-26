<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'domains',
        'order_type',
        'status',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'payment_status',
        'payment_method',
        'payment_reference',
        'paid_at',
        'billing_details',
        'order_details',
        'notes',
        'failure_reason',
        'processed_at'
    ];

    protected $casts = [
        'domains' => 'json',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'processed_at' => 'datetime',
        'billing_details' => 'json',
        'order_details' => 'json',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu Pembayaran',
            'processing' => 'Sedang Diproses',
            'completed' => 'Selesai',
            'failed' => 'Gagal',
            'cancelled' => 'Dibatalkan',
        ];

        return $texts[$this->status] ?? 'Status Tidak Diketahui';
    }

    public function getPaymentStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'refunded' => 'bg-blue-100 text-blue-800',
        ];

        return $badges[$this->payment_status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPaymentStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Terbayar',
            'failed' => 'Pembayaran Gagal',
            'refunded' => 'Dikembalikan',
        ];

        return $texts[$this->payment_status] ?? 'Status Tidak Diketahui';
    }

    public function getOrderTypeTextAttribute()
    {
        $texts = [
            'registration' => 'Registrasi Domain',
            'renewal' => 'Perpanjangan Domain',
            'transfer' => 'Transfer Domain',
        ];

        return $texts[$this->order_type] ?? 'Tipe Tidak Diketahui';
    }

    public function getDomainNamesAttribute()
    {
        return $this->domains ? implode(', ', $this->domains) : '';
    }

    // Helper Methods
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending']) && 
               in_array($this->payment_status, ['pending']);
    }

    public function canBeRefunded()
    {
        return $this->payment_status === 'paid' && 
               in_array($this->status, ['pending', 'failed']);
    }

    public function markAsPaid($paymentMethod = null, $paymentReference = null)
    {
        $this->update([
            'payment_status' => 'paid',
            'payment_method' => $paymentMethod,
            'payment_reference' => $paymentReference,
            'paid_at' => now(),
        ]);
    }

    public function markAsProcessing()
    {
        $this->update([
            'status' => 'processing',
            'processed_at' => now(),
        ]);
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'processed_at' => now(),
        ]);
    }

    public function markAsFailed($reason = null)
    {
        $this->update([
            'status' => 'failed',
            'failure_reason' => $reason,
            'processed_at' => now(),
        ]);
    }

    // Generate unique order number
    public static function generateOrderNumber()
    {
        do {
            $orderNumber = 'DOM-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
}