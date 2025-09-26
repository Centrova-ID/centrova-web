<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\RealTimeDeviceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateSessionActivity
{
    protected RealTimeDeviceService $realTimeDeviceService;

    public function __construct(RealTimeDeviceService $realTimeDeviceService)
    {
        $this->realTimeDeviceService = $realTimeDeviceService;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Update session activity if user is authenticated
        if (Auth::check()) {
            $this->updateSessionActivity($request);
        }

        return $response;
    }

    /**
     * Update session activity for the current user
     */
    private function updateSessionActivity(Request $request): void
    {
        try {
            $user = Auth::user();
            $sessionId = session()->getId();
            
            if ($user && $sessionId) {
                $this->realTimeDeviceService->updateDeviceActivity($user->id, $sessionId);
            }
        } catch (\Exception $e) {
            // Log error but don't interrupt the request
            Log::warning('Failed to update session activity: ' . $e->getMessage());
        }
    }
}
