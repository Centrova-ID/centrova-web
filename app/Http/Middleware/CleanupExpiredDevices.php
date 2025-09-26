<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\TrustedDevice;
use Illuminate\Support\Facades\Log;

class CleanupExpiredDevices
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Run cleanup occasionally (not on every request to avoid performance issues)
        if (rand(1, 100) <= 5) { // 5% chance
            try {
                $deletedCount = TrustedDevice::cleanupExpired();
                if ($deletedCount > 0) {
                    Log::info("Cleaned up {$deletedCount} expired trusted devices");
                }
            } catch (\Exception $e) {
                Log::error("Failed to cleanup expired devices: " . $e->getMessage());
            }
        }

        return $next($request);
    }
}
