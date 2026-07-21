<?php

/**
 * Vercel Serverless Entry Point for Laravel
 */

// 1. Setup writable paths di /tmp (serverless filesystem read-only)
$tmpStorage = $_ENV['VERCEL_STORAGE_PATH'] ?? '/tmp/laravel-storage';
$storageDirs = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/bootstrap/cache',
    $tmpStorage . '/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Set environment variables untuk storage & compiled views
$_ENV['APP_STORAGE'] = $tmpStorage;
$_ENV['VIEW_COMPILED_PATH'] = $tmpStorage . '/framework/views';

// 2. Serve static assets langsung jika ada di public/
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

if ($uri !== '/' && file_exists($file = __DIR__ . '/../public' . $uri)) {
    header('Content-type: ' . get_mime_type($file) . '; charset: UTF-8;');
    readfile($file);
    exit(0);
}

// 3. Bootstrapping Laravel secara manual
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override storage path secara eksplisit pada instance Laravel
$app->useStoragePath($tmpStorage);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);

/**
 * Get MIME type for a file based on its extension.
 */
function get_mime_type(string $filename): string
{
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $mimes = [
        'txt' => 'text/plain',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'svg' => 'image/svg+xml',
        'ico' => 'image/vnd.microsoft.icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'otf' => 'font/otf',
        'pdf' => 'application/pdf',
    ];

    return $mimes[$extension] ?? 'application/octet-stream';
}
