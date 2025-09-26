<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Account\UserLoginActivity;
use App\Services\LoginAlertService;
use Illuminate\Support\Facades\Log;

class ProcessLoginAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public UserLoginActivity $loginActivity;

    /**
     * Create a new job instance.
     */
    public function __construct(UserLoginActivity $loginActivity)
    {
        $this->loginActivity = $loginActivity;
    }

    /**
     * Execute the job.
     */
    public function handle(LoginAlertService $loginAlertService): void
    {
        try {
            $loginAlertService->processLoginActivity($this->loginActivity);
        } catch (\Exception $e) {
            Log::error('Failed to process login alert job', [
                'login_activity_id' => $this->loginActivity->id,
                'user_id' => $this->loginActivity->user_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e; // Re-throw to trigger job retry
        }
    }
}
