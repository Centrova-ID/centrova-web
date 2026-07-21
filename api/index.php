<?php

/**
 * Vercel Serverless Entry Point for Laravel
 * 
 * This file serves as the PHP serverless function entry point for Vercel.
 * It routes static assets from the public/ directory and forwards all
 * other requests to Laravel's public/index.php.
 * 
 * @see https://github.com/vercel-community/php
 */

// ──────────────────────────────────────────────
// Serverless Bootstrap — setup writable paths
// ──────────────────────────────────────────────

// Use /tmp for all writable storage (serverless filesystem is read-only except /tmp)
$tmpStorage = $_ENV['VERCEL_STORAGE_PATH'] ?? '/tmp/laravel-storage';
$storageDirs = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpStorage . '/app/public',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Override Laravel's storage path so compiled views, logs, etc write to /tmp
$_ENV['APP_STORAGE_PATH'] = $tmpStorage;

// Ensure the real storage link exists for public assets
$publicStorage = __DIR__ . '/../public/storage';
if (!is_dir($publicStorage) && is_dir($tmpStorage . '/app/public')) {
    @symlink($tmpStorage . '/app/public', $publicStorage);
}

// ──────────────────────────────────────────────
// Serve static assets
// ──────────────────────────────────────────────

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

if ($uri !== '/' && file_exists($file = __DIR__ . '/../public' . $uri)) {
    header('Content-type: ' . get_mime_type($file) . '; charset: UTF-8;');
    readfile($file);
    return;
}

// ──────────────────────────────────────────────
// Boot Laravel
// ──────────────────────────────────────────────

require_once __DIR__ . '/../public/index.php';

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
        // images
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'svg' => 'image/svg+xml',
        'ico' => 'image/vnd.microsoft.icon',
        // fonts
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'otf' => 'font/otf',
        'eot' => 'application/vnd.ms-fontobject',
        // archives
        'zip' => 'application/zip',
        'gz' => 'application/gzip',
        // audio/video
        'mp3' => 'audio/mpeg',
        'mp4' => 'video/mp4',
        'pdf' => 'application/pdf',
    ];

    return $mimes[$extension] ?? 'application/octet-stream';
}
