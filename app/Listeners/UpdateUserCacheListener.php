<?php

namespace App\Listeners;

use App\Events\UserLoginEvent;
use App\Jobs\WarmUpUserCacheJob;
use App\Services\AccountDataCacheService;
use App\Services\SecurityScoreService;
use App\Services\RealTimeDeviceService;
use Illuminate\Support\Facades\Log;

class UpdateUserCacheListener
{
    protected AccountDataCacheService $cacheService;
    protected SecurityScoreService $securityScoreService;
    protected RealTimeDeviceService $deviceService;

    public function __construct(
        AccountDataCacheService $cacheService,
        SecurityScoreService $securityScoreService,
        RealTimeDeviceService $deviceService
    ) {
        $this->cacheService = $cacheService;
        $this->securityScoreService = $securityScoreService;
        $this->deviceService = $deviceService;
    }

    /**
     * Handle the event when user logs in
     */
    public function handle(UserLoginEvent $event): void
    {
        try {
            $loginActivity = $event->loginActivity;
            $userId = $loginActivity->user_id;
            
            Log::info("Updating cache for user login: {$userId}");

            // Clear existing cache to ensure fresh data
            $this->clearUserCaches($userId);

            // Only warm up cache for successful logins
            if ($loginActivity->login_status === 'success') {
                // Dispatch job to warm up cache with new data
                WarmUpUserCacheJob::dispatch($loginActivity->user)->delay(now()->addSeconds(5));
            }

        } catch (\Exception $e) {
            Log::error("Failed to update user cache on login: " . $e->getMessage());
        }
    }

    /**
     * Clear all caches for a user
     */
    private function clearUserCaches(int $userId): void
    {
        $this->cacheService->clearUserCache($userId);
        $this->securityScoreService->clearCache($userId);
        $this->deviceService->clearCache($userId);
    }
}
