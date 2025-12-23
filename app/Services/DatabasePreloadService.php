<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

/**
 * DATABASE PRELOAD SERVICE
 * Load frequently accessed data into memory at boot
 * Zero query time during requests
 */
class DatabasePreloadService
{
    protected array $preloadConfig = [
        'users.count' => [
            'query' => 'SELECT COUNT(*) as count FROM users',
            'ttl' => 600,
            'key' => 'preload:users:count',
        ],
        'products.featured' => [
            'query' => 'SELECT id, name, price FROM service_orders WHERE featured = 1 LIMIT 10',
            'ttl' => 900,
            'key' => 'preload:products:featured',
        ],
        'categories.all' => [
            'query' => 'SELECT id, name, slug FROM categories ORDER BY name',
            'ttl' => 3600,
            'key' => 'preload:categories:all',
        ],
    ];

    /**
     * Preload all configured queries
     */
    public function preloadAll(): void
    {
        foreach ($this->preloadConfig as $name => $config) {
            $this->preload($config);
        }
    }

    /**
     * Preload specific query
     */
    public function preload(array $config): void
    {
        Cache::remember($config['key'], $config['ttl'], function () use ($config) {
            return DB::select($config['query']);
        });
    }

    /**
     * Get preloaded data (instant, no query)
     */
    public function get(string $key, $default = null)
    {
        $fullKey = 'preload:' . $key;
        return Cache::get($fullKey, $default);
    }

    /**
     * Preload on application boot
     */
    public function bootPreload(): void
    {
        // Only preload in production
        if (!app()->environment('production')) {
            return;
        }

        // Run in background to not block boot
        dispatch(function () {
            $this->preloadAll();
        })->afterResponse();
    }
}
