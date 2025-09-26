<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCacheUpdateEvent
{
    use Dispatchable, SerializesModels;

    public User $user;
    public string $reason;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, string $reason = 'general_update')
    {
        $this->user = $user;
        $this->reason = $reason;
    }
}
