<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Configuration
    |--------------------------------------------------------------------------
    | Centrova High-Performance Configuration
    | Target: <100ms page refresh/reload
    |
    */

    // Response Cache TTL (in seconds)
    'cache' => [
        'ttl' => [
            'static_pages' => env('CACHE_STATIC_TTL', 3600), // 1 hour
            'dynamic_pages' => env('CACHE_DYNAMIC_TTL', 300), // 5 minutes
            'api_responses' => env('CACHE_API_TTL', 60), // 1 minute
            'fragments' => env('CACHE_FRAGMENT_TTL', 900), // 15 minutes
            'query_results' => env('CACHE_QUERY_TTL', 600), // 10 minutes
        ],
        
        // Pre-warm cache on deployment
        'pre_warm' => [
            'enabled' => env('CACHE_PRE_WARM', true),
            'routes' => [
                '/',
                '/products',
                '/contact',
                // Add critical routes
            ],
        ],
    ],

    // Database Query Optimization
    'database' => [
        'chunk_size' => 1000,
        'eager_load_limit' => 100,
        'cache_queries' => true,
        'remember_time' => 600, // 10 minutes
    ],

    // Turbo/Hotwire Configuration
    'turbo' => [
        'enabled' => true,
        'cache_control' => 'public, max-age=300', // 5 minutes
        'etag' => true,
        'stream_delay' => 0, // No delay for instant updates
    ],

    // Asset Optimization
    'assets' => [
        'preload' => true,
        'prefetch' => true,
        'dns_prefetch' => [
            '//fonts.googleapis.com',
            '//cdn.jsdelivr.net',
        ],
        'critical_css_inline' => true,
    ],

    // HTTP/2 Server Push
    'http2_push' => [
        'enabled' => env('HTTP2_PUSH_ENABLED', true),
        'resources' => [
            '/build/assets/app.css',
            '/build/assets/app.js',
        ],
    ],

    // Response Compression
    'compression' => [
        'enabled' => true,
        'level' => 6, // 1-9 (higher = better compression, slower)
        'types' => ['text/html', 'text/css', 'application/javascript', 'application/json'],
    ],
];
