<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate staff users from staff_users table to users table
        $staffUsers = DB::table('staff_users')->get();
        
        foreach ($staffUsers as $staff) {
            // Check if user already exists with same email
            $existingUser = DB::table('users')->where('email', $staff->email)->first();
            
            if (!$existingUser) {
                DB::table('users')->insert([
                    'name' => $staff->name,
                    'email' => $staff->email,
                    'password' => $staff->password,
                    'role' => 'staff',
                    'staff_role' => $staff->role ?? 'staff',
                    'phone' => $staff->phone ?? null,
                    'birth_date' => $staff->birth_date ?? null,
                    'gender' => $staff->gender ?? null,
                    'bio' => $staff->bio ?? null,
                    'profile_picture' => $staff->profile_picture ?? null,
                    'email_verified_at' => $staff->email_verified_at,
                    'created_at' => $staff->created_at,
                    'updated_at' => $staff->updated_at,
                ]);
            } else {
                // Update existing user to staff role if needed
                if ($existingUser->role === 'customer') {
                    DB::table('users')->where('id', $existingUser->id)->update([
                        'role' => 'staff',
                        'staff_role' => $staff->role ?? 'staff',
                        'phone' => $staff->phone ?? $existingUser->phone,
                        'birth_date' => $staff->birth_date ?? $existingUser->birth_date,
                        'gender' => $staff->gender ?? $existingUser->gender,
                        'bio' => $staff->bio ?? $existingUser->bio,
                        'profile_picture' => $staff->profile_picture ?? $existingUser->profile_picture,
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove migrated staff users (optional - for safety, we keep the data)
        // DB::table('users')->where('role', 'staff')->delete();
    }
};
