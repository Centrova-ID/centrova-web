<?php

namespace App\Console\Commands;

use App\Models\Staff;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestStaff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:create-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test staff user for development';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $staff = Staff::updateOrCreate(
            ['email' => 'admin@centrova.com'],
            [
                'name' => 'Admin Centrova',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'status' => 'active',
                'email_notifications' => true,
                'security_alerts' => true,
                'staff_updates' => true,
                'marketing_emails' => false,
            ]
        );

        $this->info('Test staff user created successfully!');
        $this->line('Email: admin@centrova.com');
        $this->line('Password: password');
        $this->line('Role: admin');
        
        return Command::SUCCESS;
    }
}
