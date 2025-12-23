<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Octane Configuration
    |--------------------------------------------------------------------------
    | Laravel Octane supercharges your application with:
    | - 2-4x faster response times
    | - Persistent application state
    | - Lower memory usage per request
    |
    */

    'server' => env('OCTANE_SERVER', 'swoole'), // or 'roadrunner'

    /*
    |--------------------------------------------------------------------------
    | Octane Listeners
    |--------------------------------------------------------------------------
    */

    'listeners' => [
        WorkerStarting::class => [
            // EnsureUploadedFilesAreValid::class,
            // EnsureUploadedFilesCanBeMoved::class,
        ],

        RequestReceived::class => [
            // Custom listeners
        ],

        RequestHandled::class => [],

        RequestTerminated::class => [
            // FlushTemporaryContainerInstances::class,
        ],

        TaskReceived::class => [],
        TaskTerminated::class => [],

        TickReceived::class => [],
        TickTerminated::class => [],

        OperationTerminated::class => [],

        WorkerErrorOccurred::class => [],

        WorkerStopping::class => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Warm / Flush Bindings
    |--------------------------------------------------------------------------
    */

    'warm' => [
        // 'cache',
        // 'config',
        // 'routes',
        // 'views',
    ],

    'flush' => [
        // Flush these on every request
    ],

    /*
    |--------------------------------------------------------------------------
    | Octane Cache Table
    |--------------------------------------------------------------------------
    */

    'cache' => [
        'driver' => env('OCTANE_CACHE_DRIVER', 'octane'),
        'rows' => 1000,
    ],

    /*
    |--------------------------------------------------------------------------
    | Octane Swoole Configuration
    |--------------------------------------------------------------------------
    */

    'swoole' => [
        'options' => [
            'log_file' => storage_path('logs/swoole_http.log'),
            'package_max_length' => 10 * 1024 * 1024, // 10MB
            
            // Performance tuning
            'worker_num' => (function_exists('swoole_cpu_num') ? swoole_cpu_num() : 4) * 2,
            'task_worker_num' => function_exists('swoole_cpu_num') ? swoole_cpu_num() : 4,
            'max_request' => 1000, // Restart worker after 1000 requests
            
            // Buffering
            'buffer_output_size' => 2 * 1024 * 1024, // 2MB
            'socket_buffer_size' => 2 * 1024 * 1024,
            
            // Timeouts
            'max_wait_time' => 60,
            'reload_async' => true,
            
            // TCP optimization
            'open_tcp_nodelay' => true,
            'tcp_fastopen' => true,
            
            // HTTP
            'http_parse_post' => true,
            'http_parse_cookie' => true,
            
            // Static file serving (bypass PHP)
            'enable_static_handler' => true,
            'document_root' => public_path(),
            'static_handler_locations' => ['/build', '/storage'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | RoadRunner Configuration
    |--------------------------------------------------------------------------
    */

    'roadrunner' => [
        'workers' => env('OCTANE_WORKERS', (function_exists('swoole_cpu_num') ? swoole_cpu_num() : 4) * 2),
        'max_jobs' => env('OCTANE_MAX_JOBS', 1000),
    ],

    /*
    |--------------------------------------------------------------------------
    | File Watching
    |--------------------------------------------------------------------------
    */

    'watch' => [
        'app',
        'config',
        'routes',
        'resources/views',
    ],

    /*
    |--------------------------------------------------------------------------
    | Garbage Collection
    |--------------------------------------------------------------------------
    */

    'garbage_collection' => [
        'interval' => env('OCTANE_GC_INTERVAL', 1000), // Every 1000 requests
        'cycles' => env('OCTANE_GC_CYCLES', 2),
    ],
];
