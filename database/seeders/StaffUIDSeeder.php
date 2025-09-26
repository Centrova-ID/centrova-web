<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class StaffUIDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Generating staff UIDs...');

        // Get all staff users without UID
        $staffUsers = User::whereNotNull('role')
            ->where('role', '!=', 'customer')
            ->whereNull('staff_uid')
            ->get();

        $count = 0;
        foreach ($staffUsers as $staff) {
            $staff->assignStaffUIDIfNeeded();
            $count++;
            $this->command->info("Generated UID {$staff->staff_uid} for {$staff->name}");
        }

        $this->command->info("Successfully generated {$count} staff UIDs.");
    }
}
