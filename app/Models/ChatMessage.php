<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'sender_type',
        'message',
        'message_type',
        'file_path',
        'read_at',
        'reply_to_message_id',
        'is_starred',
        'is_deleted'
    ];

    protected $casts = [
        'read_at' => 'datetime'
    ];

    /**
     * Get the conversation that owns the message
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatConversation::class, 'conversation_id');
    }

    /**
     * Get the sender (unified User model)
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get user sender
     */
    public function userSender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get staff sender
     */
    public function staffSender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id')->where('role', '!=', 'customer');
    }

    /**
     * Get the message this is replying to
     */
    public function replyToMessage(): BelongsTo
    {
        return $this->belongsTo(ChatMessage::class, 'reply_to_message_id');
    }

    /**
     * Get replies to this message
     */
    public function replies()
    {
        return $this->hasMany(ChatMessage::class, 'reply_to_message_id');
    }

    /**
     * Check if message is from user
     */
    public function isFromUser(): bool
    {
        return $this->sender_type === 'user';
    }

    /**
     * Check if message is from staff
     */
    public function isFromStaff(): bool
    {
        return $this->sender_type === 'staff';
    }

    /**
     * Check if message is read
     */
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }

    /**
     * Get sender name
     */
    public function getSenderNameAttribute(): string
    {
        $user = User::find($this->sender_id);
        return $user ? $user->name : ($this->sender_type === 'user' ? 'User' : 'Staff');
    }

    /**
     * Get formatted created date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('M d, Y g:i A');
    }
}
