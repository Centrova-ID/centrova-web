<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Artisan;

class SetupDatabases extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'setup:databases {--create-db} {--seed}';

    /**
     * The console command description.
     */
    protected $description = 'Setup all databases for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database setup...');

        $createDb = $this->option('create-db');
        $seed = $this->option('seed');

        // Test connections first
        $this->info('Testing database connections...');
        $connections = DatabaseHelper::testConnections();
        
        foreach ($connections as $connection => $status) {
            if (str_contains($status, 'Failed')) {
                $this->error("❌ {$connection}: {$status}");
            } else {
                $this->info("✅ {$connection}: {$status}");
            }
        }

        // Create databases if requested
        if ($createDb) {
            $this->info("\nCreating databases...");
            
            try {
                DatabaseHelper::createDatabase('account');
                $this->info("✅ Database 'centrova_account' created/verified");
            } catch (\Exception $e) {
                $this->error("❌ Failed to create centrova_account: " . $e->getMessage());
            }

            try {
                DatabaseHelper::createDatabase('services');
                $this->info("✅ Database 'centrova_services' created/verified");
            } catch (\Exception $e) {
                $this->error("❌ Failed to create centrova_services: " . $e->getMessage());
            }
        }

        // Run migrations
        $this->info("\nRunning migrations...");

        // Default database migrations
        $this->info("Running default database migrations...");
        try {
            Artisan::call('migrate', ['--force' => true]);
            $this->info("✅ Default database migrations completed");
        } catch (\Exception $e) {
            $this->error("❌ Default database migration failed: " . $e->getMessage());
        }

        // Account database migrations
        $this->info("Running account database migrations...");
        try {
            Artisan::call('migrate', [
                '--database' => 'account',
                '--force' => true
            ]);
            $this->info("✅ Account database migrations completed");
        } catch (\Exception $e) {
            $this->error("❌ Account database migration failed: " . $e->getMessage());
        }

        // Services database migrations
        $this->info("Running services database migrations...");
        try {
            Artisan::call('migrate', [
                '--database' => 'services',
                '--path' => 'database/migrations/services',
                '--force' => true
            ]);
            $this->info("✅ Services database migrations completed");
        } catch (\Exception $e) {
            $this->error("❌ Services database migration failed: " . $e->getMessage());
        }

        // Run seeders if requested
        if ($seed) {
            $this->info("\nRunning seeders...");

            // Services seeder
            try {
                Artisan::call('db:seed', [
                    '--class' => 'ServicesSeeder',
                    '--database' => 'services'
                ]);
                $this->info("✅ Services database seeded");
            } catch (\Exception $e) {
                $this->error("❌ Services seeding failed: " . $e->getMessage());
            }

            // Default seeder
            try {
                Artisan::call('db:seed');
                $this->info("✅ Default database seeded");
            } catch (\Exception $e) {
                $this->error("❌ Default seeding failed: " . $e->getMessage());
            }
        }

        $this->info("\n🎉 Database setup completed!");
        
        // Final connection test
        $this->info("\nFinal connection test:");
        $finalConnections = DatabaseHelper::testConnections();
        
        foreach ($finalConnections as $connection => $status) {
            if (str_contains($status, 'Failed')) {
                $this->error("❌ {$connection}: {$status}");
            } else {
                $this->info("✅ {$connection}: {$status}");
            }
        }

        return 0;
    }
}
