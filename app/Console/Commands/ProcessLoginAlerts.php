<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LoginAlertService;
use App\Models\Account\UserLoginActivity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProcessLoginAlerts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'login-alerts:process {--days=1 : Number of days to process}';

    /**
     * The description of the console command.
     */
    protected $description = 'Process recent login activities and generate alerts for suspicious activities';

    protected LoginAlertService $loginAlertService;

    public function __construct(LoginAlertService $loginAlertService)
    {
        parent::__construct();
        $this->loginAlertService = $loginAlertService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $this->info("Processing login activities from the last {$days} day(s)...");

        $startTime = now();
        $cutoffDate = now()->subDays($days);

        // Get recent login activities that haven't been processed for alerts
        $loginActivities = DB::connection('account')
            ->table('user_login_activities')
            ->where('login_at', '>=', $cutoffDate)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('login_alerts')
                    ->whereColumn('login_alerts.login_activity_id', 'user_login_activities.id');
            })
            ->orderBy('login_at', 'desc')
            ->get();

        $processedCount = 0;
        $alertsGenerated = 0;

        $progressBar = $this->output->createProgressBar($loginActivities->count());
        $progressBar->start();

        foreach ($loginActivities as $activityData) {
            // Convert to UserLoginActivity model
            $activity = new UserLoginActivity((array) $activityData);
            $activity->id = $activityData->id;
            $activity->exists = true;

            try {
                // Process the login activity
                $alertsBefore = DB::connection('account')
                    ->table('login_alerts')
                    ->where('user_id', $activity->user_id)
                    ->count();

                $this->loginAlertService->processLoginActivity($activity);

                $alertsAfter = DB::connection('account')
                    ->table('login_alerts')
                    ->where('user_id', $activity->user_id)
                    ->count();

                $alertsGenerated += ($alertsAfter - $alertsBefore);
                $processedCount++;

            } catch (\Exception $e) {
                $this->error("Error processing login activity ID {$activity->id}: " . $e->getMessage());
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        $executionTime = $startTime->diffInSeconds(now());

        $this->info("Processing completed!");
        $this->table(
            ['Metric', 'Value'],
            [
                ['Login Activities Processed', number_format($processedCount)],
                ['Alerts Generated', number_format($alertsGenerated)],
                ['Execution Time', "{$executionTime} seconds"],
                ['Average per Activity', $processedCount > 0 ? round($executionTime / $processedCount, 3) . ' seconds' : '0 seconds'],
            ]
        );

        // Show breakdown by alert type
        $alertBreakdown = DB::connection('account')
            ->table('login_alerts')
            ->select('alert_type', 'severity', DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', $startTime)
            ->groupBy('alert_type', 'severity')
            ->orderBy('count', 'desc')
            ->get();

        if ($alertBreakdown->count() > 0) {
            $this->newLine();
            $this->info("Alerts generated in this run:");
            $this->table(
                ['Alert Type', 'Severity', 'Count'],
                $alertBreakdown->map(function ($item) {
                    return [
                        ucfirst(str_replace('_', ' ', $item->alert_type)),
                        ucfirst($item->severity),
                        $item->count
                    ];
                })->toArray()
            );
        }

        return Command::SUCCESS;
    }
}
