<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffUser;
use Illuminate\Support\Facades\Hash;

class StaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main admin user
        StaffUser::create([
            'name' => 'System Administrator',
            'email' => 'admin@centrova.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create sample staff users
        StaffUser::create([
            'name' => 'John Manager',
            'email' => 'manager@centrova.com',
            'role' => 'manager',
            'password' => Hash::make('manager123'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        StaffUser::create([
            'name' => 'Jane Support',
            'email' => 'support@centrova.com',
            'role' => 'customer_service',
            'password' => Hash::make('support123'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        StaffUser::create([
            'name' => 'Mike Developer',
            'email' => 'dev@centrova.com',
            'role' => 'developer',
            'password' => Hash::make('dev123'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        StaffUser::create([
            'name' => 'Sarah Marketing',
            'email' => 'marketing@centrova.com',
            'role' => 'marketing',
            'password' => Hash::make('marketing123'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Staff users created successfully!');
        $this->command->info('Admin: admin@centrova.com / admin123');
        $this->command->info('Manager: manager@centrova.com / manager123');
        $this->command->info('Support: support@centrova.com / support123');
        $this->command->info('Developer: dev@centrova.com / dev123');
        $this->command->info('Marketing: marketing@centrova.com / marketing123');
    }
}
