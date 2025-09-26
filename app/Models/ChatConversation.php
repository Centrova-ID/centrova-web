<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_id',
        'subject',
        'status',
        'priority',
        'last_message_at',
        'is_pinned_by_staff',
        'is_hidden_by_staff'
    ];

    protected $casts = [
        'last_message_at' => 'datetime'
    ];

    /**
     * Get the user that owns the conversation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staff assigned to the conversation
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id')->where('role', '!=', 'customer');
    }

    /**
     * Get all messages for the conversation
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id')->orderBy('created_at', 'asc');
    }

    /**
     * Get the latest message
     */
    public function latestMessage(): BelongsTo
    {
        return $this->belongsTo(ChatMessage::class, 'id', 'conversation_id')
                    ->latest('created_at');
    }

    /**
     * Check if conversation is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if conversation is waiting for staff
     */
    public function isWaiting(): bool
    {
        return $this->status === 'waiting';
    }

    /**
     * Check if conversation is closed
     */
    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    /**
     * Assign staff to conversation
     */
    public function assignStaff(User $staff): void
    {
        $this->update([
            'staff_id' => $staff->id,
            'status' => 'active'
        ]);
    }

    /**
     * Close the conversation
     */
    public function close(): void
    {
        $this->update(['status' => 'closed']);
    }

    /**
     * Reopen the conversation
     */
    public function reopen(): void
    {
        $this->update([
            'status' => 'waiting',
            'last_message_at' => now()
        ]);
    }

    /**
     * Get unread messages count for staff (with caching)
     */
    public function getUnreadCountForStaff(): int
    {
        $cacheKey = "unread_staff_{$this->id}";
        
        return cache()->remember($cacheKey, 60, function () {
            return $this->messages()
                        ->where('sender_type', 'user')
                        ->whereNull('read_at')
                        ->count();
        });
    }

    /**
     * Get unread messages count for user (with caching)
     */
    public function getUnreadCountForUser(): int
    {
        $cacheKey = "unread_user_{$this->id}";
        
        return cache()->remember($cacheKey, 60, function () {
            return $this->messages()
                        ->where('sender_type', 'staff')
                        ->whereNull('read_at')
                        ->count();
        });
    }

    /**
     * Mark messages as read by staff
     */
    public function markAsReadByStaff(): void
    {
        $this->messages()
             ->where('sender_type', 'user')
             ->whereNull('read_at')
             ->update(['read_at' => now()]);
             
        // Clear cache
        cache()->forget("unread_staff_{$this->id}");
    }

    /**
     * Mark messages as read by user
     */
    public function markAsReadByUser(): void
    {
        $this->messages()
             ->where('sender_type', 'staff')
             ->whereNull('read_at')
             ->update(['read_at' => now()]);
             
        // Clear cache
        cache()->forget("unread_user_{$this->id}");
    }
}
