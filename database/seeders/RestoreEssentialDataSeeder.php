<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StaffUser;

class RestoreEssentialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin staff user
        $adminStaff = StaffUser::firstOrCreate([
            'email' => 'admin@centrova.com'
        ], [
            'name' => 'Admin Centrova',
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
            'phone' => '+62812345678',
            'department' => 'IT',
            'position' => 'System Administrator',
            'hire_date' => now(),
            'email_verified_at' => now(),
        ]);

        // Create privacy officer
        $privacyOfficer = StaffUser::firstOrCreate([
            'email' => 'privacy@centrova.com'
        ], [
            'name' => 'Privacy Officer',
            'username' => 'privacy',
            'password' => Hash::make('privacy123'),
            'role' => 'privacy_officer',
            'status' => 'active',
            'phone' => '+62812345679',
            'department' => 'Legal',
            'position' => 'Data Privacy Officer',
            'hire_date' => now(),
            'email_verified_at' => now(),
        ]);

        // Create regular staff
        $staff = StaffUser::firstOrCreate([
            'email' => 'staff@centrova.com'
        ], [
            'name' => 'Staff Centrova',
            'username' => 'staff',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
            'status' => 'active',
            'phone' => '+62812345680',
            'department' => 'Customer Service',
            'position' => 'Customer Support',
            'hire_date' => now(),
            'email_verified_at' => now(),
        ]);

        // Create demo user
        $user = User::firstOrCreate([
            'email' => 'demo@centrova.com'
        ], [
            'name' => 'Demo User',
            'username' => 'demo',
            'password' => Hash::make('demo123'),
            'email_verified_at' => now(),
            'phone' => '+62812345681',
            'address' => 'Jakarta, Indonesia',
        ]);

        $this->command->info('Essential data restored successfully!');
        $this->command->info('Staff Users:');
        $this->command->info('- Admin: admin@centrova.com / password123');
        $this->command->info('- Privacy Officer: privacy@centrova.com / privacy123');
        $this->command->info('- Staff: staff@centrova.com / staff123');
        $this->command->info('Demo User: demo@centrova.com / demo123');
    }
}
