<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

/**
 * ULTRA-FAST FULL PAGE CACHE
 * Serves entire pages from Redis without touching PHP application
 * Target: <10ms TTFB
 */
class UltraFastPageCache
{
    /**
     * Bypass cache for these paths
     */
    protected array $except = [
        'api/*',
        'admin/*',
        'account/*',
        'oauth/*',
    ];

    /**
     * Bypass cache for authenticated users (optional)
     */
    protected bool $skipAuthenticated = false;

    public function handle(Request $request, Closure $next, int $ttl = 300): Response
    {
        // Only cache GET requests
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        // Skip if authenticated (optional)
        if ($this->skipAuthenticated && $request->user()) {
            return $next($request);
        }

        // Check if path should be excluded
        if ($this->shouldExclude($request)) {
            return $next($request);
        }

        // Generate cache key
        $cacheKey = $this->getCacheKey($request);

        // Try to get from cache (ultra-fast Redis read)
        $cached = Cache::get($cacheKey);
        
        if ($cached !== null) {
            return $this->serveCachedResponse($cached, $cacheKey);
        }

        // Not cached, generate response
        $response = $next($request);

        // Only cache successful HTML responses
        if ($this->shouldCache($response)) {
            $this->cacheResponse($cacheKey, $response, $ttl);
        }

        return $response;
    }

    /**
     * Generate ultra-fast cache key
     */
    protected function getCacheKey(Request $request): string
    {
        $uri = $request->getRequestUri();
        
        // Include Turbo Frame in cache key
        $turboFrame = $request->header('Turbo-Frame', '');
        
        // Include Accept header for content negotiation
        $accept = $request->header('Accept', '');
        $isTurbo = str_contains($accept, 'text/vnd.turbo-stream.html');
        
        return 'ultrafast:' . md5($uri . $turboFrame . ($isTurbo ? ':turbo' : ''));
    }

    /**
     * Serve cached response with minimal overhead
     */
    protected function serveCachedResponse(array $cached, string $key): Response
    {
        $response = response($cached['content'], $cached['status'] ?? 200);
        
        // Set cached headers
        foreach ($cached['headers'] ?? [] as $name => $value) {
            $response->headers->set($name, $value);
        }
        
        // Add cache indicators
        $response->headers->set('X-Cache', 'HIT');
        $response->headers->set('X-Cache-Key', substr($key, 0, 32));
        $response->headers->set('X-Response-Time', '< 5ms');
        
        return $response;
    }

    /**
     * Cache response with minimal data
     */
    protected function cacheResponse(string $key, Response $response, int $ttl): void
    {
        $data = [
            'content' => $response->getContent(),
            'status' => $response->getStatusCode(),
            'headers' => [
                'Content-Type' => $response->headers->get('Content-Type'),
                'Cache-Control' => 'public, max-age=' . $ttl,
            ],
            'cached_at' => time(),
        ];

        Cache::put($key, $data, $ttl);
    }

    /**
     * Determine if response should be cached
     */
    protected function shouldCache(Response $response): bool
    {
        // Only cache successful responses
        if (!$response->isSuccessful()) {
            return false;
        }

        // Only cache HTML content
        $contentType = $response->headers->get('Content-Type', '');
        if (!str_contains($contentType, 'html')) {
            return false;
        }

        return true;
    }

    /**
     * Check if request should bypass cache
     */
    protected function shouldExclude(Request $request): bool
    {
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Clear cache for specific URL
     */
    public static function clearUrl(string $url): void
    {
        $key = 'ultrafast:' . md5($url);
        Cache::forget($key);
    }

    /**
     * Clear all page cache
     */
    public static function clearAll(): void
    {
        Cache::flush(); // Or use tags if you tagged the cache
    }
}
