<?php

namespace App\Listeners;

use App\Events\SessionUpdated;
use App\Services\RealTimeDeviceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClearDeviceCache
{
    private RealTimeDeviceService $realTimeDeviceService;

    /**
     * Create the event listener.
     */
    public function __construct(RealTimeDeviceService $realTimeDeviceService)
    {
        $this->realTimeDeviceService = $realTimeDeviceService;
    }

    /**
     * Handle the event.
     */
    public function handle(SessionUpdated $event): void
    {
        // Clear device cache when session is updated
        $this->realTimeDeviceService->clearCache($event->userId);
        
        // Also clear account overview cache
        Cache::forget("account_overview_user_{$event->userId}");
        
        // Log the cache clearing for debugging
        Log::info("Device cache cleared for user {$event->userId} due to session {$event->action}");
    }
}
