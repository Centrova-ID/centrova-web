<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Failed;
use App\Models\User;

class CaptureFailedLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Check if this is a login attempt that failed
        if ($request->is('login') && $request->isMethod('POST') && !Auth::check()) {
            $credentials = $request->only('email', 'username');
            
            // Try to find user by email or username
            $user = null;
            if (isset($credentials['email'])) {
                $user = User::where('email', $credentials['email'])->first();
            } elseif (isset($credentials['username'])) {
                $user = User::where('username', $credentials['username'])->first();
            }

            if ($user) {
                // Fire failed login event
                Event::dispatch(new Failed('web', $user, $credentials));
            }
        }

        return $response;
    }
}
