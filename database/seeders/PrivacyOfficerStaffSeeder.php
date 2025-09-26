<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class PrivacyOfficerStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Privacy Officer if doesn't exist
        $privacyOfficer = Staff::where('email', 'privacy@centrova.com')->first();
        
        if (!$privacyOfficer) {
            Staff::create([
                'name' => 'Privacy Officer',
                'email' => 'privacy@centrova.com',
                'phone' => '+62 812-3456-7890',
                'password' => Hash::make('privacy123'),
                'role' => 'privacy_officer',
                'status' => 'active',
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('Privacy Officer created successfully!');
            $this->command->info('Email: privacy@centrova.com');
            $this->command->info('Password: privacy123');
        } else {
            $this->command->info('Privacy Officer already exists.');
        }
    }
}
