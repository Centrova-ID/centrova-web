<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccountDataCacheService
{
    /**
     * Get account overview data with caching
     */
    public function getAccountOverview(User $user): array
    {
        $cacheKey = "account_overview_user_{$user->id}";
        
        return Cache::remember($cacheKey, 600, function () use ($user) { // Cache for 10 minutes
            return [
                'subscription' => $this->getSubscriptionData($user),
                'service_orders' => $this->getServiceOrdersData($user),
                'profile_completeness' => $this->calculateProfileCompleteness($user),
            ];
        });
    }

    /**
     * Get subscription data
     */
    private function getSubscriptionData(User $user): ?object
    {
        return DB::table('subscriptions')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Get service orders data
     */
    private function getServiceOrdersData(User $user): array
    {
        try {
            $activeOrders = DB::table('service_orders')
                ->where('user_id', $user->id)
                ->whereIn('status', ['pending', 'in_progress', 'development'])
                ->count();

            $totalOrders = DB::table('service_orders')
                ->where('user_id', $user->id)
                ->count();

            return [
                'active' => $activeOrders,
                'total' => $totalOrders
            ];
        } catch (\Exception $e) {
            return [
                'active' => 0,
                'total' => 0
            ];
        }
    }

    /**
     * Calculate profile completeness percentage
     */
    private function calculateProfileCompleteness(User $user): int
    {
        $completeness = 0;
        $maxPoints = 100;
        
        // Basic information (40 points)
        if ($user->name) $completeness += 10;
        if ($user->email) $completeness += 10;
        if ($user->email_verified_at) $completeness += 10;
        if ($user->phone) $completeness += 10;
        
        // Profile details (40 points)
        if ($user->profile_picture) $completeness += 15;
        if ($user->birth_date) $completeness += 10;
        if ($user->gender) $completeness += 5;
        if ($user->address || $user->city) $completeness += 10;
        
        // Security settings (20 points)
        if ($user->twoFactorAuth && $user->twoFactorAuth->is_enabled) $completeness += 15;
        if ($user->password_updated_at && Carbon::parse($user->password_updated_at)->gt(now()->subDays(90))) {
            $completeness += 5;
        }
        
        return min($completeness, $maxPoints);
    }

    /**
     * Clear all cache for a user
     */
    public function clearUserCache(int $userId): void
    {
        $patterns = [
            "account_overview_user_{$userId}",
            "security_score_user_{$userId}",
            "realtime_devices_user_{$userId}",
        ];

        foreach ($patterns as $pattern) {
            Cache::forget($pattern);
        }
    }

    /**
     * Warm up cache for a user
     */
    public function warmUpCache(User $user): void
    {
        // Pre-load commonly accessed data
        $this->getAccountOverview($user);
        
        // Trigger security score calculation
        app(SecurityScoreService::class)->calculateSecurityScore($user);
        
        // Trigger device data loading
        app(RealTimeDeviceService::class)->getRealTimeDevices($user);
    }

    /**
     * Get cache statistics for monitoring
     */
    public function getCacheStats(): array
    {
        // This would typically connect to Redis or your cache store
        // for detailed statistics
        return [
            'cache_hits' => 0,
            'cache_misses' => 0,
            'cache_size' => 0,
            'last_updated' => now()
        ];
    }
}
