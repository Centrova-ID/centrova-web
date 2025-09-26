<?php

namespace App\Listeners;

use App\Events\UserLoginEvent;
use App\Jobs\ProcessLoginAlertJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessLoginAlerts implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(UserLoginEvent $event): void
    {
        try {
            // Dispatch job to process login alerts asynchronously
            ProcessLoginAlertJob::dispatch($event->loginActivity);
        } catch (\Exception $e) {
            Log::error('Failed to dispatch login alert job', [
                'login_activity_id' => $event->loginActivity->id,
                'user_id' => $event->loginActivity->user_id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
