<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class PerformanceHelper
{
    /**
     * Cache duration constants (in seconds)
     */
    const CACHE_SHORT = 300;      // 5 minutes
    const CACHE_MEDIUM = 1800;    // 30 minutes
    const CACHE_LONG = 3600;      // 1 hour
    const CACHE_DAY = 86400;      // 24 hours
    const CACHE_WEEK = 604800;    // 7 days

    /**
     * Remember data with configurable cache duration
     * 
     * @param string $key Cache key
     * @param callable $callback Data retrieval callback
     * @param int $duration Cache duration in seconds
     * @return mixed
     */
    public static function remember(string $key, callable $callback, int $duration = self::CACHE_LONG)
    {
        return Cache::remember($key, $duration, $callback);
    }

    /**
     * Cache static page content (rarely changes)
     * 
     * @param string $key Cache key
     * @param callable $callback Data retrieval callback
     * @return mixed
     */
    public static function cacheStaticContent(string $key, callable $callback)
    {
        return self::remember($key, $callback, self::CACHE_DAY);
    }

    /**
     * Cache dynamic content (changes frequently)
     * 
     * @param string $key Cache key
     * @param callable $callback Data retrieval callback
     * @return mixed
     */
    public static function cacheDynamicContent(string $key, callable $callback)
    {
        return self::remember($key, $callback, self::CACHE_SHORT);
    }

    /**
     * Cache list/collection data
     * 
     * @param string $key Cache key
     * @param callable $callback Data retrieval callback
     * @return mixed
     */
    public static function cacheList(string $key, callable $callback)
    {
        return self::remember($key, $callback, self::CACHE_MEDIUM);
    }

    /**
     * Forget multiple cache keys at once
     * 
     * @param array $keys Array of cache keys to forget
     * @return void
     */
    public static function forgetMultiple(array $keys)
    {
        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Clear cache by pattern/prefix
     * 
     * @param string $prefix Cache key prefix
     * @return void
     */
    public static function clearByPrefix(string $prefix)
    {
        if (config('cache.default') === 'redis') {
            $redis = Cache::getRedis();
            $keys = $redis->keys($prefix . '*');
            if (!empty($keys)) {
                $redis->del($keys);
            }
        } else {
            // For file/database cache, just forget specific keys
            // This is a limitation - consider using Redis for production
        }
    }

    /**
     * Get cache statistics (useful for monitoring)
     * 
     * @return array
     */
    public static function getCacheStats(): array
    {
        return [
            'driver' => config('cache.default'),
            'prefix' => config('cache.prefix'),
            'redis_connected' => self::isRedisAvailable(),
        ];
    }

    /**
     * Check if Redis is available
     * 
     * @return bool
     */
    public static function isRedisAvailable(): bool
    {
        try {
            if (config('cache.default') === 'redis') {
                Cache::getRedis()->ping();
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
}
