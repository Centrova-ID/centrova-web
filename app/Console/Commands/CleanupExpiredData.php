<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CleanupExpiredData extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'data:cleanup 
                            {--type= : Specific data type to clean}
                            {--dry-run : Show what would be deleted without actually deleting}
                            {--force : Force cleanup without confirmation}';

    /**
     * The console command description.
     */
    protected $description = 'Clean up expired data based on retention policies (GDPR compliance)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧹 Starting GDPR Data Cleanup Process...');
        $this->newLine();

        $isDryRun = $this->option('dry-run');
        $isForced = $this->option('force');
        $specificType = $this->option('type');

        // Get retention policies
        $policies = DB::table('data_retention_policies')
            ->where('is_active', true)
            ->when($specificType, function ($query, $type) {
                return $query->where('data_type', $type);
            })
            ->get();

        if ($policies->isEmpty()) {
            $this->warn('No active retention policies found.');
            return 0;
        }

        $totalCleaned = 0;
        $results = [];

        foreach ($policies as $policy) {
            $this->info("Processing: {$policy->data_type}");
            
            try {
                $deletedCount = $this->cleanupDataType($policy, $isDryRun);
                $totalCleaned += $deletedCount;
                
                $results[] = [
                    'Type' => $policy->data_type,
                    'Table' => $policy->table_name,
                    'Retention' => "{$policy->retention_days} days",
                    'Deleted' => $deletedCount,
                    'Status' => $deletedCount > 0 ? '✅ Cleaned' : '✅ Nothing to clean'
                ];

                if (!$isDryRun && $deletedCount > 0) {
                    // Update last cleanup timestamp
                    DB::table('data_retention_policies')
                        ->where('id', $policy->id)
                        ->update(['last_cleanup_at' => now()]);
                }

            } catch (\Exception $e) {
                $this->error("Failed to cleanup {$policy->data_type}: " . $e->getMessage());
                Log::error("Data cleanup failed for {$policy->data_type}", [
                    'error' => $e->getMessage(),
                    'policy_id' => $policy->id
                ]);
                
                $results[] = [
                    'Type' => $policy->data_type,
                    'Table' => $policy->table_name,
                    'Retention' => "{$policy->retention_days} days",
                    'Deleted' => 0,
                    'Status' => '❌ Error: ' . substr($e->getMessage(), 0, 30) . '...'
                ];
            }
        }

        $this->newLine();
        $this->table(
            ['Data Type', 'Table', 'Retention Period', 'Records Processed', 'Status'],
            $results
        );

        $this->newLine();
        if ($isDryRun) {
            $this->warn("🔍 DRY RUN COMPLETED - No data was actually deleted");
            $this->info("Total records that would be deleted: {$totalCleaned}");
        } else {
            $this->info("✅ CLEANUP COMPLETED");
            $this->info("Total records deleted: {$totalCleaned}");
            
            // Log successful cleanup
            Log::info('GDPR Data cleanup completed', [
                'total_deleted' => $totalCleaned,
                'policies_processed' => count($policies),
                'timestamp' => now()
            ]);
        }

        return 0;
    }

    /**
     * Cleanup data for a specific retention policy
     */
    private function cleanupDataType($policy, $isDryRun = false)
    {
        $cutoffDate = Carbon::now()->subDays($policy->retention_days);
        
        // Build query
        $query = DB::table($policy->table_name)
            ->where($policy->date_column, '<', $cutoffDate);

        // Apply additional conditions if specified
        if ($policy->conditions) {
            $conditions = json_decode($policy->conditions, true);
            foreach ($conditions as $column => $value) {
                if (is_array($value)) {
                    $query->whereIn($column, $value);
                } else {
                    $query->where($column, $value);
                }
            }
        }

        // Count records that would be deleted
        $count = $query->count();

        if ($count === 0) {
            return 0;
        }

        $this->line("  → Found {$count} records older than {$policy->retention_days} days");

        if ($isDryRun) {
            return $count;
        }

        // Show sample of records to be deleted (for confirmation)
        if (!$this->option('force') && $count > 0) {
            $sample = $query->limit(3)->get();
            $this->line("  → Sample records to be deleted:");
            foreach ($sample as $record) {
                $date = $record->{$policy->date_column};
                $this->line("    • ID: {$record->id}, Date: {$date}");
            }
            
            if (!$this->confirm("Continue with deletion of {$count} records from {$policy->table_name}?")) {
                $this->line("  → Skipped by user");
                return 0;
            }
        }

        // Perform deletion in chunks to avoid memory issues
        $deleted = 0;
        $chunkSize = 1000;

        while (true) {
            $recordsToDelete = DB::table($policy->table_name)
                ->where($policy->date_column, '<', $cutoffDate);

            // Apply conditions again
            if ($policy->conditions) {
                $conditions = json_decode($policy->conditions, true);
                foreach ($conditions as $column => $value) {
                    if (is_array($value)) {
                        $recordsToDelete->whereIn($column, $value);
                    } else {
                        $recordsToDelete->where($column, $value);
                    }
                }
            }

            $batch = $recordsToDelete->limit($chunkSize)->pluck('id');
            
            if ($batch->isEmpty()) {
                break;
            }

            $batchDeleted = DB::table($policy->table_name)
                ->whereIn('id', $batch)
                ->delete();

            $deleted += $batchDeleted;
            
            $this->line("  → Deleted batch: {$batchDeleted} records");
        }

        return $deleted;
    }
}
