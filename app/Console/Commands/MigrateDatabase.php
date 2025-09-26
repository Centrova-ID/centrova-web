<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'migrate:database {connection} {--path=} {--force}';

    /**
     * The console command description.
     */
    protected $description = 'Run migration for specific database connection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = $this->argument('connection');
        $path = $this->option('path');
        $force = $this->option('force');

        $this->info("Running migrations for connection: {$connection}");

        $options = [
            '--database' => $connection,
        ];

        if ($path) {
            $options['--path'] = $path;
        }

        if ($force) {
            $options['--force'] = true;
        }

        try {
            Artisan::call('migrate', $options);
            $this->info(Artisan::output());
            $this->info("Migrations completed successfully for {$connection}!");
        } catch (\Exception $e) {
            $this->error("Migration failed: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
