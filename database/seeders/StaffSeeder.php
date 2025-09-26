<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\StaffUser;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StaffUser::create([
            'name' => 'Test Staff',
            'email' => 'staff@centrova.com',
            'password' => Hash::make('password123'),
            'role' => 'customer_service',
            'phone' => '08123456789',
            'bio' => 'Test staff for customer service',
            'status' => 'active',
        ]);
    }
}
