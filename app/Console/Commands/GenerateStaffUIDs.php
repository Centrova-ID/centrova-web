<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateStaffUIDs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:generate-uids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate UIDs for staff users who don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating staff UIDs...');

        $staffUsers = User::whereNotNull('role')
            ->where('role', '!=', 'customer')
            ->whereNull('staff_uid')
            ->get();

        if ($staffUsers->isEmpty()) {
            $this->info('All staff users already have UIDs assigned.');
            return;
        }

        $count = 0;
        foreach ($staffUsers as $staff) {
            $staff->assignStaffUIDIfNeeded();
            $count++;
            $this->info("Generated UID {$staff->staff_uid} for {$staff->name}");
        }

        $this->info("Successfully generated {$count} staff UIDs.");
    }
}
