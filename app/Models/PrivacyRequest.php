<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivacyRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'customer_email',
        'customer_name',
        'phone',
        'type',
        'description',
        'status',
        'priority',
        'template_id',
        'response_content',
        'response_sent_at',
        'due_date',
        'assigned_to',
        'processed_by',
        'notes',
        'attachments'
    ];

    protected $casts = [
        'response_sent_at' => 'datetime',
        'due_date' => 'datetime',
        'attachments' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    // Request types
    const TYPE_DATA_ACCESS = 'data_access';
    const TYPE_DATA_DELETION = 'data_deletion';
    const TYPE_DATA_PORTABILITY = 'data_portability';
    const TYPE_CONSENT_WITHDRAWAL = 'consent_withdrawal';
    const TYPE_DATA_CORRECTION = 'data_correction';
    const TYPE_COMPLAINT = 'complaint';

    // Status types
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELLED = 'cancelled';

    // Priority levels
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    public static function getRequestTypes()
    {
        return [
            self::TYPE_DATA_ACCESS => 'Data Access Request',
            self::TYPE_DATA_DELETION => 'Data Deletion Request',
            self::TYPE_DATA_PORTABILITY => 'Data Portability Request',
            self::TYPE_CONSENT_WITHDRAWAL => 'Consent Withdrawal',
            self::TYPE_DATA_CORRECTION => 'Data Correction',
            self::TYPE_COMPLAINT => 'Privacy Complaint'
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending Review',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_CANCELLED => 'Cancelled'
        ];
    }

    public static function getPriorities()
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
            self::PRIORITY_URGENT => 'Urgent'
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function template()
    {
        return $this->belongsTo(PrivacyTemplate::class);
    }

    // Helper methods
    public function isOverdue()
    {
        return $this->due_date && $this->due_date->isPast() && $this->status !== self::STATUS_COMPLETED;
    }

    public function getDaysRemaining()
    {
        if (!$this->due_date) return null;
        
        return now()->diffInDays($this->due_date, false);
    }

    public function getStatusBadgeColor()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'yellow',
            self::STATUS_IN_PROGRESS => 'blue',
            self::STATUS_COMPLETED => 'green',
            self::STATUS_REJECTED => 'red',
            self::STATUS_CANCELLED => 'gray',
            default => 'gray'
        };
    }

    public function getPriorityBadgeColor()
    {
        return match($this->priority) {
            self::PRIORITY_LOW => 'gray',
            self::PRIORITY_MEDIUM => 'yellow',
            self::PRIORITY_HIGH => 'orange',
            self::PRIORITY_URGENT => 'red',
            default => 'gray'
        };
    }
}
