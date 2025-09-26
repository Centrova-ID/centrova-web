<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StaffUser;
use Illuminate\Support\Facades\DB;

class MergeStaffToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting migration of staff data to users table...');
        
        // Get all staff users
        $staffUsers = StaffUser::all();
        
        foreach ($staffUsers as $staff) {
            // Check if user with same email already exists
            $existingUser = User::where('email', $staff->email)->first();
            
            if ($existingUser) {
                // Update existing user with staff role
                $existingUser->update([
                    'role' => $staff->role,
                    'status' => $staff->status,
                    'last_login_at' => $staff->last_login_at,
                    'bio' => $staff->bio ?? null,
                    'email_notifications' => $staff->email_notifications ?? true,
                    'marketing_emails' => $staff->marketing_emails ?? true,
                    'security_alerts' => $staff->security_alerts ?? true,
                    'staff_updates' => $staff->staff_updates ?? true,
                ]);
                
                $this->command->info("Updated existing user: {$staff->email} with role: {$staff->role}");
            } else {
                // Create new user from staff data
                // Generate username from email
                $username = explode('@', $staff->email)[0];
                $originalUsername = $username;
                $counter = 1;
                
                // Ensure username is unique
                while (User::where('username', $username)->exists()) {
                    $username = $originalUsername . $counter;
                    $counter++;
                }
                
                User::create([
                    'name' => $staff->name,
                    'username' => $username, // Generated from email
                    'email' => $staff->email,
                    'password' => $staff->password,
                    'role' => $staff->role,
                    'status' => $staff->status,
                    'last_login_at' => $staff->last_login_at,
                    'email_verified_at' => $staff->email_verified_at,
                    'phone' => $staff->phone ?? null,
                    'bio' => $staff->bio ?? null,
                    'profile_picture' => $staff->profile_picture ?? null,
                    'email_notifications' => $staff->email_notifications ?? true,
                    'marketing_emails' => $staff->marketing_emails ?? true,
                    'security_alerts' => $staff->security_alerts ?? true,
                    'staff_updates' => $staff->staff_updates ?? true,
                    'created_at' => $staff->created_at,
                    'updated_at' => $staff->updated_at,
                ]);
                
                $this->command->info("Created new user from staff: {$staff->email} with username: {$username} and role: {$staff->role}");
            }
        }
        
        $this->command->info('Staff data migration completed!');
        $this->command->info('Total staff migrated: ' . $staffUsers->count());
    }
}
