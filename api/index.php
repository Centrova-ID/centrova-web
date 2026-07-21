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

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Serve static assets directly if they exist in public/
if ($uri !== '/' && file_exists($file = __DIR__ . '/../public' . $uri)) {
    header('Content-type: ' . get_mime_type($file) . '; charset: UTF-8;');
    readfile($file);
    return;
}

// Forward all other requests to Laravel
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
