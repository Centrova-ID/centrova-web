<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

/**
 * Advanced Cache Service
 * Implements multi-tier caching with Redis as primary and file as fallback
 */
class CacheService
{
    protected $defaultTTL = 600; // 10 minutes

    /**
     * Get from cache with automatic fallback
     */
    public function remember(string $key, $ttl, callable $callback)
    {
        $ttl = $ttl ?? $this->defaultTTL;

        try {
            // Try Redis first
            return Cache::tags(['app'])->remember($key, $ttl, $callback);
        } catch (\Exception $e) {
            \Log::warning('Redis cache failed, using fallback', [
                'key' => $key,
                'error' => $e->getMessage()
            ]);
            
            // Fallback to file cache
            return Cache::store('file')->remember($key, $ttl, $callback);
        }
    }

    /**
     * Cache database queries with tags
     */
    public function rememberQuery(string $key, $ttl, callable $callback, array $tags = [])
    {
        $allTags = array_merge(['queries'], $tags);
        $ttl = $ttl ?? config('performance.database.remember_time', 600);

        return Cache::tags($allTags)->remember($key, $ttl, $callback);
    }

    /**
     * Cache view fragments
     */
    public function rememberFragment(string $key, $ttl, callable $callback)
    {
        $ttl = $ttl ?? config('performance.cache.ttl.fragments', 900);
        
        return Cache::tags(['fragments'])->remember($key, $ttl, $callback);
    }

    /**
     * Invalidate cache by tags
     */
    public function invalidateTags(array $tags): void
    {
        try {
            Cache::tags($tags)->flush();
        } catch (\Exception $e) {
            \Log::error('Cache tag invalidation failed', [
                'tags' => $tags,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Invalidate specific key
     */
    public function forget(string $key): void
    {
        Cache::forget($key);
    }

    /**
     * Pre-warm cache for critical routes
     */
    public function preWarmCache(): void
    {
        if (!config('performance.cache.pre_warm.enabled')) {
            return;
        }

        $routes = config('performance.cache.pre_warm.routes', []);

        foreach ($routes as $route) {
            try {
                $this->warmRoute($route);
            } catch (\Exception $e) {
                \Log::error('Failed to warm cache for route: ' . $route, [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

    /**
     * Warm a specific route
     */
    protected function warmRoute(string $route): void
    {
        // Make internal request to generate cache
        $response = app('router')->dispatch(
            \Illuminate\Http\Request::create($route, 'GET')
        );

        \Log::info('Cache warmed for route: ' . $route);
    }

    /**
     * Get cache statistics
     */
    public function getStats(): array
    {
        try {
            $redis = Redis::connection();
            $info = $redis->info();

            return [
                'hits' => $info['Stats']['keyspace_hits'] ?? 0,
                'misses' => $info['Stats']['keyspace_misses'] ?? 0,
                'memory_used' => $info['Memory']['used_memory_human'] ?? 'N/A',
                'uptime' => $info['Server']['uptime_in_seconds'] ?? 0,
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Unable to fetch cache stats',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Atomic cache increment
     */
    public function increment(string $key, int $value = 1): int
    {
        return Cache::increment($key, $value);
    }

    /**
     * Atomic cache decrement
     */
    public function decrement(string $key, int $value = 1): int
    {
        return Cache::decrement($key, $value);
    }

    /**
     * Store data permanently (until manually cleared)
     */
    public function forever(string $key, $value): void
    {
        Cache::forever($key, $value);
    }

    /**
     * Check if key exists
     */
    public function has(string $key): bool
    {
        return Cache::has($key);
    }
}
