<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\DetectsFallbackRoute;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Device;
use App\Models\Subscription;
use App\Models\TrustedDevice;
use App\Services\LoginActivityService;
use App\Services\MultiAccountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Cache;

class AccountController extends Controller
{
    use DetectsFallbackRoute;
    protected LoginActivityService $loginActivityService;
    protected MultiAccountService $multiAccountService;

    public function __construct(LoginActivityService $loginActivityService, MultiAccountService $multiAccountService)
    {
        $this->loginActivityService = $loginActivityService;
        $this->multiAccountService = $multiAccountService;
    }

    /**
     * Optimized account method with caching and efficient queries
     */
    public function accountOptimized()
    {
        $user = auth()->user();
        $userId = $user->id;
        
        // Cache key untuk user-specific data
        $cacheKey = "account_data_user_{$userId}";
        
        // Cache data untuk 5 menit (300 seconds)
        $accountData = Cache::remember($cacheKey, 300, function () use ($user, $userId) {
            return $this->getAccountData($user, $userId);
        });
        
        // Data yang tidak perlu di-cache (real-time data)
        $realtimeData = $this->getRealtimeData($userId);
        
        return view('auth.account', array_merge($accountData, $realtimeData));
    }

    /**
     * Get account data yang bisa di-cache
     */
    private function getAccountData($user, $userId)
    {
        // Single query untuk devices dengan optimized columns
        $devices = DB::table('devices')
            ->select([
                'id', 'device_name', 'device_type', 'ip_address', 
                'location', 'last_active_at', 'created_at'
            ])
            ->where('user_id', $userId)
            ->orderBy('last_active_at', 'desc')
            ->limit(10) // Batasi hanya 10 devices terbaru
            ->get();

        $deviceCount = $devices->count();

        // Single query untuk latest subscription dengan select optimized
        $subscription = DB::table('subscriptions')
            ->select(['plan', 'status', 'started_at', 'expires_at', 'created_at'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        // Optimized query untuk service orders dengan single query untuk both counts
        $serviceOrderStats = DB::table('service_orders')
            ->selectRaw('
                COUNT(*) as total_orders,
                SUM(CASE WHEN status IN ("pending", "in_progress", "development") THEN 1 ELSE 0 END) as active_orders
            ')
            ->where('user_id', $userId)
            ->first();

        $activeOrders = $serviceOrderStats->active_orders ?? 0;
        $totalOrders = $serviceOrderStats->total_orders ?? 0;

        // Security score calculation (cached)
        $securityScore = $this->calculateSecurityScore($user, $subscription, $deviceCount);

        return compact(
            'user', 
            'deviceCount', 
            'devices', 
            'subscription',
            'activeOrders',
            'totalOrders',
            'securityScore'
        );
    }

    /**
     * Get real-time data yang tidak boleh di-cache
     */
    private function getRealtimeData($userId)
    {
        // Recent login activities - hanya ambil yang paling recent
        try {
            $recentActivities = DB::table('user_login_activities')
                ->select([
                    'ip_address', 'device_type', 'browser', 'login_status',
                    'login_at', 'is_suspicious', 'location'
                ])
                ->where('user_id', $userId)
                ->orderBy('login_at', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            $recentActivities = collect([]);
        }

        return compact('recentActivities');
    }

    /**
     * Calculate security score dengan optimized logic
     */
    private function calculateSecurityScore($user, $subscription, $deviceCount)
    {
        $score = 60; // Base score
        
        // Subscription bonus
        if ($subscription && $subscription->status === 'active') {
            $score += 10;
        }
        
        // Device count bonus (less devices = more secure)
        if ($deviceCount <= 3) {
            $score += 10;
        }
        
        // Email verification bonus
        if ($user->email_verified_at) {
            $score += 10;
        }
        
        // Phone number bonus
        if ($user->phone) {
            $score += 10;
        }
        
        return min($score, 100); // Cap at 100
    }

    /**
     * Method untuk clear cache saat ada update
     */
    public function clearAccountCache($userId = null)
    {
        $userId = $userId ?? auth()->id();
        $cacheKey = "account_data_user_{$userId}";
        Cache::forget($cacheKey);
    }

    // ... method lainnya tetap sama
}
