<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get test user
        $user = User::where('username', 'testuser')->first();
        
        if ($user) {
            Subscription::create([
                'user_id' => $user->id,
                'plan' => 'Pro Plan',
                'status' => 'active',
                'started_at' => now()->subMonths(2),
                'expires_at' => now()->addMonths(10)
            ]);
        }
        
        // Get second user if exists
        $user2 = User::where('username', 'fadli')->first();
        
        if ($user2) {
            Subscription::create([
                'user_id' => $user2->id,
                'plan' => 'Basic Plan',
                'status' => 'active',
                'started_at' => now()->subMonths(1),
                'expires_at' => now()->addMonths(11)
            ]);
        }
    }
}
