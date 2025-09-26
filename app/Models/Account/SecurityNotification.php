<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SecurityNotification extends Model
{
    use HasFactory;

    protected $connection = 'account';
    protected $table = 'security_notifications';

    protected $fillable = [
        'user_id',
        'notification_id',
        'type',
        'title',
        'message',
        'severity',
        'data',
        'read'
    ];

    protected $casts = [
        'data' => 'array',
        'read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get time in readable format
     */
    public function getTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get formatted timestamp
     */
    public function getTimestampAttribute()
    {
        return $this->created_at->toISOString();
    }

    /**
     * Scope for unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    /**
     * Scope for specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for specific severity
     */
    public function scopeBySeverity($query, $severity)
    {
        return $query->where('severity', $severity);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->update(['read' => true]);
    }

    /**
     * Get severity color class
     */
    public function getSeverityColorAttribute()
    {
        return match($this->severity) {
            'high' => 'border-red-500 bg-red-50 text-red-800',
            'medium' => 'border-orange-500 bg-orange-50 text-orange-800',
            'low' => 'border-blue-500 bg-blue-50 text-blue-800',
            default => 'border-gray-500 bg-gray-50 text-gray-800'
        };
    }

    /**
     * Get text color class
     */
    public function getTextColorAttribute()
    {
        return match($this->severity) {
            'high' => 'text-red-700',
            'medium' => 'text-orange-700',
            'low' => 'text-blue-700',
            default => 'text-gray-700'
        };
    }

    /**
     * Get icon color class
     */
    public function getIconColorAttribute()
    {
        return match($this->severity) {
            'high' => 'text-red-600',
            'medium' => 'text-orange-600',
            'low' => 'text-blue-600',
            default => 'text-gray-600'
        };
    }
}
