<?php

namespace App\Services;

use League\Glide\ServerFactory;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

class GlideService
{
    /**
     * Get the manipulated image URL (for Blade views)
     */
    public function imageUrl(string $path, array $params = []): string
    {
        $path = ltrim($path, '/');
        $query = http_build_query($params);
        return $query ? "/img/{$path}?{$query}" : "/img/{$path}";
    }

    /**
     * Process image and return response
     */
    public function getImageResponse(string $path, array $params = [])
    {
        $path = ltrim($path, '/');

        // Cari file
        $searchPaths = [
            public_path($path),
            public_path('assets/' . $path),
        ];

        $foundPath = null;
        $relativePath = null;
        foreach ($searchPaths as $sp) {
            if (file_exists($sp)) {
                $foundPath = $sp;
                $relativePath = str_replace(public_path() . '/', '', $sp);
                break;
            }
        }

        if (!$foundPath) {
            abort(404, "Image not found: {$path}");
        }

        // Jika tidak ada parameter manipulasi, return original
        if (empty($params)) {
            $mime = mime_content_type($foundPath);
            return response(file_get_contents($foundPath), 200, [
                'Content-Type' => $mime,
                'Cache-Control' => 'public, max-age=31536000, immutable',
            ]);
        }

        try {
            // Gunakan Intervention Image untuk manipulasi
            $manager = new \Intervention\Image\ImageManager(\Intervention\Image\Drivers\Gd\Driver::class);
            $image = $manager->decodePath($foundPath);

            if (isset($params['w'])) {
                $width = (int) $params['w'];
                $fit = $params['fit'] ?? 'contain';

                if ($fit === 'crop') {
                    $height = isset($params['h']) ? (int) $params['h'] : $width;
                    $image->cover($width, $height);
                } elseif ($fit === 'contain') {
                    $height = isset($params['h']) ? (int) $params['h'] : null;
                    $image->scaleDown(width: $width, height: $height);
                } else {
                    $height = isset($params['h']) ? (int) $params['h'] : null;
                    $image->resize($width, $height);
                }
            } elseif (isset($params['h'])) {
                $height = (int) $params['h'];
                $image->scaleDown(height: $height);
            }

            // Quality
            $quality = isset($params['q']) ? (int) $params['q'] : 80;

            // Encode to WebP
            $encoded = $image->encodeUsingMediaType('image/webp', quality: $quality);

            return response($encoded, 200, [
                'Content-Type' => 'image/webp',
                'Cache-Control' => 'public, max-age=31536000, immutable',
                'Expires' => gmdate('D, d M Y H:i:s T', time() + 31536000),
            ]);
        } catch (\Exception $e) {
            // Fallback: return original
            $mime = mime_content_type($foundPath);
            return response(file_get_contents($foundPath), 200, [
                'Content-Type' => $mime,
            ]);
        }
    }

    /**
     * Generate responsive image srcset
     */
    public function srcset(string $path, array $widths = [400, 800, 1200, 1600], string $fit = 'contain'): string
    {
        $path = ltrim($path, '/');
        $parts = [];
        foreach ($widths as $w) {
            $parts[] = "/img/{$path}?w={$w}&fit={$fit} {$w}w";
        }
        return implode(', ', $parts);
    }
}
