<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\AccountDataCacheService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class WarmUpUserCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(AccountDataCacheService $cacheService): void
    {
        try {
            Log::info("Warming up cache for user {$this->user->id}");
            
            $cacheService->warmUpCache($this->user);
            
            Log::info("Cache warmed up successfully for user {$this->user->id}");
        } catch (\Exception $e) {
            Log::error("Failed to warm up cache for user {$this->user->id}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff = 10;
}
