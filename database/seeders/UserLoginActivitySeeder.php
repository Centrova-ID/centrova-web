<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account\UserLoginActivity;
use Carbon\Carbon;

class UserLoginActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing activities first
        UserLoginActivity::truncate();
        
        $userId = 1; // Test user ID
        $now = Carbon::now('Asia/Jakarta');
        
        // Create recent login activities with accurate timestamps
        $activities = [
            [
                'user_id' => $userId,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.0.0',
                'device_type' => 'desktop',
                'browser' => 'Edge',
                'operating_system' => 'Windows',
                'location' => 'Jakarta, Indonesia',
                'country_code' => 'ID',
                'login_status' => 'success',
                'failure_reason' => null,
                'is_suspicious' => false,
                'login_at' => $now->copy()->subMinutes(1), // 1 menit yang lalu
                'created_at' => $now->copy()->subMinutes(1),
                'updated_at' => $now->copy()->subMinutes(1)
            ],
            [
                'user_id' => $userId,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'device_type' => 'desktop',
                'browser' => 'Chrome',
                'operating_system' => 'Windows',
                'location' => 'Jakarta, Indonesia',
                'country_code' => 'ID',
                'login_status' => 'success',
                'failure_reason' => null,
                'is_suspicious' => false,
                'login_at' => $now->copy()->subMinutes(30), // 30 menit yang lalu
                'created_at' => $now->copy()->subMinutes(30),
                'updated_at' => $now->copy()->subMinutes(30)
            ],
            [
                'user_id' => $userId,
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
                'device_type' => 'mobile',
                'browser' => 'Safari',
                'operating_system' => 'iOS',
                'location' => 'Jakarta, Indonesia',
                'country_code' => 'ID',
                'login_status' => 'success',
                'failure_reason' => null,
                'is_suspicious' => false,
                'login_at' => $now->copy()->subHours(2), // 2 jam yang lalu
                'created_at' => $now->copy()->subHours(2),
                'updated_at' => $now->copy()->subHours(2)
            ],
            [
                'user_id' => $userId,
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'device_type' => 'desktop',
                'browser' => 'Chrome',
                'operating_system' => 'macOS',
                'location' => 'Jakarta, Indonesia',
                'country_code' => 'ID',
                'login_status' => 'success',
                'failure_reason' => null,
                'is_suspicious' => false,
                'login_at' => $now->copy()->subHours(5), // 5 jam yang lalu
                'created_at' => $now->copy()->subHours(5),
                'updated_at' => $now->copy()->subHours(5)
            ],
            [
                'user_id' => $userId,
                'ip_address' => '203.78.121.45',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0',
                'device_type' => 'desktop',
                'browser' => 'Firefox',
                'operating_system' => 'Windows',
                'location' => 'Surabaya, Indonesia',
                'country_code' => 'ID',
                'login_status' => 'failed',
                'failure_reason' => 'Invalid password',
                'is_suspicious' => true,
                'login_at' => $now->copy()->subDay(1), // 1 hari yang lalu
                'created_at' => $now->copy()->subDay(1),
                'updated_at' => $now->copy()->subDay(1)
            ]
        ];
        
        foreach ($activities as $activity) {
            UserLoginActivity::create($activity);
        }
    }
}
