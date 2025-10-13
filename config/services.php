<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'fonnte' => [
        'url' => env('FONNTE_URL', 'https://api.fonnte.com/send'),
        'token' => env('FONNTE_TOKEN'),
    ],

    'resellerclub' => [
        'api_url' => env('RESELLERCLUB_API_URL', 'https://test.httpapi.com/api/'),
        'api_key' => env('RESELLERCLUB_API_KEY', 'demo-key'),
        'user_id' => env('RESELLERCLUB_USER_ID', 'demo-user'),
    ],

    'domain_registrar' => [
        'provider' => env('DOMAIN_REGISTRAR_PROVIDER', 'resellerclub'),
        'api_url' => env('DOMAIN_REGISTRAR_API_URL', 'https://api.resellerclub.com'),
        'api_key' => env('DOMAIN_REGISTRAR_API_KEY', 'demo-key'),
        'user_id' => env('DOMAIN_REGISTRAR_USER_ID', 'demo-user'),
    ],

    'google' => [
        'analytics_id' => env('GOOGLE_ANALYTICS_ID'),
        'site_verification' => env('GOOGLE_SITE_VERIFICATION'),
        'tag_manager_id' => env('GOOGLE_TAG_MANAGER_ID'),
    ],

    'bing' => [
        'site_verification' => env('BING_SITE_VERIFICATION'),
    ],

    'facebook' => [
        'app_id' => env('FACEBOOK_APP_ID'),
        'pixel_id' => env('FACEBOOK_PIXEL_ID'),
    ],

    'twitter' => [
        'site' => env('TWITTER_SITE', '@centrova_id'),
        'creator' => env('TWITTER_CREATOR', '@centrova_id'),
    ],

];
