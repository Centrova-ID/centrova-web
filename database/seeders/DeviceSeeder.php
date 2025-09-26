<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\User;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get test user
        $user = User::where('username', 'testuser')->first();
        
        if ($user) {
            Device::create([
                'user_id' => $user->id,
                'device_name' => 'Chrome Windows',
                'device_type' => 'Desktop',
                'ip_address' => '192.168.1.100',
                'location' => 'Jakarta, Indonesia',
                'last_active_at' => now()
            ]);
            
            Device::create([
                'user_id' => $user->id,
                'device_name' => 'iPhone 15',
                'device_type' => 'Mobile',
                'ip_address' => '192.168.1.101',
                'location' => 'Jakarta, Indonesia',
                'last_active_at' => now()->subHours(2)
            ]);
            
            Device::create([
                'user_id' => $user->id,
                'device_name' => 'MacBook Pro',
                'device_type' => 'Laptop',
                'ip_address' => '192.168.1.102',
                'location' => 'Jakarta, Indonesia',
                'last_active_at' => now()->subDays(1)
            ]);
        }
    }
}
