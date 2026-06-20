<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Account\User;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create test user if not exists
        User::firstOrCreate(
            ['email' => 'test@centrova.id'],
            [
                'name' => 'Test User',
                'username' => 'testuser',
                'email' => 'test@centrova.id',
                'password' => Hash::make('password'),
                'phone' => '+62812345678',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Test user created successfully!');
    }
}
