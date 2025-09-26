<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeviceSessionSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get a test user (assuming user ID 1 exists)
        $userId = 1;
        
        $sessions = [
            [
                'id' => Str::random(40),
                'user_id' => $userId,
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
                'payload' => base64_encode(serialize(['_token' => Str::random(40), '_previous' => ['url' => 'http://localhost']])),
                'last_activity' => now()->subMinutes(5)->timestamp,
            ],
            [
                'id' => Str::random(40),
                'user_id' => $userId,
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
                'payload' => base64_encode(serialize(['_token' => Str::random(40), '_previous' => ['url' => 'http://localhost']])),
                'last_activity' => now()->subMinutes(30)->timestamp,
            ],
            [
                'id' => Str::random(40),
                'user_id' => $userId,
                'ip_address' => '203.142.12.45',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
                'payload' => base64_encode(serialize(['_token' => Str::random(40), '_previous' => ['url' => 'http://localhost']])),
                'last_activity' => now()->subHours(2)->timestamp,
            ],
            [
                'id' => Str::random(40),
                'user_id' => $userId,
                'ip_address' => '180.242.215.10',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:119.0) Gecko/20100101 Firefox/119.0',
                'payload' => base64_encode(serialize(['_token' => Str::random(40), '_previous' => ['url' => 'http://localhost']])),
                'last_activity' => now()->subHours(6)->timestamp,
            ],
            [
                'id' => Str::random(40),
                'user_id' => $userId,
                'ip_address' => '114.79.32.200',
                'user_agent' => 'Mozilla/5.0 (iPad; CPU OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
                'payload' => base64_encode(serialize(['_token' => Str::random(40), '_previous' => ['url' => 'http://localhost']])),
                'last_activity' => now()->subDays(1)->timestamp,
            ],
        ];

        // Insert sessions using the account connection
        foreach ($sessions as $session) {
            DB::connection('account')->table('sessions')->insert($session);
        }

        $this->command->info('Device session test data created successfully!');
    }
}
