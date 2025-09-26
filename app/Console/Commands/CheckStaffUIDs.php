<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckStaffUIDs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:check-uids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and display staff UIDs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking staff UIDs...');

        $staffUsers = User::whereNotNull('role')
            ->where('role', '!=', 'customer')
            ->get(['id', 'name', 'email', 'role', 'staff_uid']);

        if ($staffUsers->isEmpty()) {
            $this->warn('No staff users found.');
            return;
        }

        $this->table(
            ['ID', 'Name', 'Email', 'Role', 'Staff UID'],
            $staffUsers->map(function ($user) {
                return [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    $user->staff_uid ?? 'Not assigned'
                ];
            })
        );

        $missingUIDs = $staffUsers->whereNull('staff_uid');
        if ($missingUIDs->isNotEmpty()) {
            $this->warn("Found {$missingUIDs->count()} staff users without UID. Run: php artisan staff:generate-uids");
        } else {
            $this->info('All staff users have UIDs assigned.');
        }
    }
}
