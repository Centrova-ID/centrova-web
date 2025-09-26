<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Account\UserLoginActivity;

class UserLoginEvent
{
    use Dispatchable, SerializesModels;

    public UserLoginActivity $loginActivity;

    /**
     * Create a new event instance.
     */
    public function __construct(UserLoginActivity $loginActivity)
    {
        $this->loginActivity = $loginActivity;
    }
}
