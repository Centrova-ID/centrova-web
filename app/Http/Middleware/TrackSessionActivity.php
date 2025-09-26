<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Account\Session;
use Carbon\Carbon;

class TrackSessionActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $this->updateSessionActivity($request);
        }

        return $next($request);
    }

    /**
     * Update session activity.
     */
    private function updateSessionActivity(Request $request)
    {
        try {
            $sessionId = session()->getId();
            $userId = Auth::id();

            if (!$sessionId || !$userId) {
                return; // Skip if no session or user
            }

            // Check if session exists first
            $sessionExists = DB::connection('account')->table('sessions')
                ->where('id', $sessionId)
                ->exists();

            if ($sessionExists) {
                // Update existing session
                DB::connection('account')->table('sessions')
                    ->where('id', $sessionId)
                    ->update([
                        'user_id' => $userId,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'last_activity' => time(),
                    ]);
            } else {
                // Create new session record
                DB::connection('account')->table('sessions')->insert([
                    'id' => $sessionId,
                    'user_id' => $userId,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'payload' => base64_encode(serialize([])),
                    'last_activity' => time(),
                ]);
            }
                
        } catch (\Exception $e) {
            // Log error but don't break the request
            Log::error('Failed to update session activity: ' . $e->getMessage());
        }
    }
}
