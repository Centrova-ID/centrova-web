<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Domain Reseller Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the domain reseller system
    | including API credentials and default settings.
    |
    */

    // API Configuration
    'api_base_url' => env('DOMAIN_API_BASE_URL', 'https://test.httpapi.com/api/'),
    'api_key' => env('DOMAIN_API_KEY'),
    'reseller_id' => env('DOMAIN_RESELLER_ID'),
    'api_username' => env('DOMAIN_API_USERNAME'),
    'api_password' => env('DOMAIN_API_PASSWORD'),

    // Default nameservers
    'default_nameservers' => [
        'ns1.centrova.com',
        'ns2.centrova.com',
    ],

    // Domain settings
    'settings' => [
        'max_domains_per_order' => 10,
        'max_years_registration' => 10,
        'min_years_registration' => 1,
        'auto_renewal_days_before_expiry' => 30,
        'expiry_notification_days' => [30, 14, 7, 1],
    ],

    // Featured TLDs for homepage
    'featured_tlds' => [
        '.com',
        '.id',
        '.net',
        '.co.id',
        '.web.id',
    ],

    // Popular TLDs for search suggestions
    'popular_tlds' => [
        '.com',
        '.id',
        '.net',
        '.org',
        '.co.id',
        '.web.id',
        '.info',
        '.biz',
    ],

    // Shopping cart settings
    'cart' => [
        'session_key' => 'domain_cart',
        'expiry_minutes' => 60,
    ],

    // Payment settings
    'payment' => [
        'tax_rate' => 0.11, // 11% PPN
        'currency' => 'IDR',
        'supported_methods' => [
            'bank_transfer',
            'credit_card',
            'e_wallet',
        ],
    ],

    // Email settings
    'email' => [
        'from_address' => env('DOMAIN_EMAIL_FROM', 'noreply@centrova.com'),
        'from_name' => env('DOMAIN_EMAIL_FROM_NAME', 'Centrova Domain Services'),
        'templates' => [
            'registration_success' => 'emails.domain.registration-success',
            'renewal_reminder' => 'emails.domain.renewal-reminder',
            'expiry_warning' => 'emails.domain.expiry-warning',
            'renewal_success' => 'emails.domain.renewal-success',
        ],
    ],

    // Cache settings
    'cache' => [
        'availability_ttl' => 300, // 5 minutes
        'pricing_ttl' => 3600,     // 1 hour
        'suggestions_ttl' => 1800, // 30 minutes
    ],

    // Validation rules
    'validation' => [
        'domain_name_regex' => '/^[a-z0-9][a-z0-9\-]{0,61}[a-z0-9]$/',
        'min_domain_length' => 2,
        'max_domain_length' => 63,
        'blocked_words' => [
            'admin',
            'administrator',
            'root',
            'system',
            'www',
            'mail',
            'email',
            'ftp',
            'test',
        ],
    ],

    // Cron job settings
    'cron' => [
        'sync_domains' => '0 2 * * *',        // Daily at 2 AM
        'check_expiry' => '0 8 * * *',        // Daily at 8 AM  
        'send_reminders' => '0 9 * * *',      // Daily at 9 AM
        'cleanup_failed_orders' => '0 3 * * 0', // Weekly on Sunday at 3 AM
    ],

    // Logging
    'logging' => [
        'channel' => env('DOMAIN_LOG_CHANNEL', 'daily'),
        'level' => env('DOMAIN_LOG_LEVEL', 'info'),
    ],

    // Feature flags
    'features' => [
        'domain_transfer' => env('DOMAIN_TRANSFER_ENABLED', false),
        'bulk_operations' => env('DOMAIN_BULK_ENABLED', true),
        'whois_privacy' => env('DOMAIN_WHOIS_PRIVACY_ENABLED', false),
        'dns_management' => env('DOMAIN_DNS_MANAGEMENT_ENABLED', true),
    ],
];