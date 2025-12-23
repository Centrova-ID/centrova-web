<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

/**
 * High-Performance Response Cache Middleware
 * Implements aggressive caching for Turbo-compatible responses
 */
class PerformanceCacheMiddleware
{
    protected $excludedPaths = [
        'api/*',
        'admin/*',
        'account/*',
        'oauth/*',
    ];

    protected $excludedParams = ['_turbo_frame', 'preview', 'debug'];

    public function handle(Request $request, Closure $next, ?string $ttl = null): Response
    {
        // Skip caching for non-GET requests
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        // Skip for authenticated users (optional, adjust based on needs)
        // if ($request->user()) {
        //     return $next($request);
        // }

        // Skip excluded paths
        if ($this->shouldExclude($request)) {
            return $next($request);
        }

        $cacheKey = $this->getCacheKey($request);
        $cacheTTL = $ttl ?? config('performance.cache.ttl.dynamic_pages', 300);

        // Check if we have a cached response
        if (Cache::tags(['responses'])->has($cacheKey)) {
            $cachedResponse = Cache::tags(['responses'])->get($cacheKey);
            
            return response($cachedResponse['content'])
                ->withHeaders([
                    'Content-Type' => $cachedResponse['content_type'] ?? 'text/html',
                    'X-Cache-Hit' => 'true',
                    'X-Cache-Key' => $cacheKey,
                    'Cache-Control' => 'public, max-age=' . $cacheTTL,
                ]);
        }

        // Generate response
        $response = $next($request);

        // Only cache successful responses
        if ($response->isSuccessful() && $response instanceof \Illuminate\Http\Response) {
            Cache::tags(['responses'])->put($cacheKey, [
                'content' => $response->getContent(),
                'content_type' => $response->headers->get('Content-Type'),
            ], $cacheTTL);

            $response->headers->set('X-Cache-Hit', 'false');
            $response->headers->set('X-Cache-Key', $cacheKey);
            $response->headers->set('Cache-Control', 'public, max-age=' . $cacheTTL);
        }

        return $response;
    }

    protected function getCacheKey(Request $request): string
    {
        $uri = $request->getRequestUri();
        $queryParams = $request->query();
        
        // Remove excluded params
        foreach ($this->excludedParams as $param) {
            unset($queryParams[$param]);
        }

        $queryString = http_build_query($queryParams);
        $key = 'response:' . md5($uri . $queryString);

        // Add Turbo-specific caching
        if ($request->header('Turbo-Frame')) {
            $key .= ':frame:' . $request->header('Turbo-Frame');
        }

        return $key;
    }

    protected function shouldExclude(Request $request): bool
    {
        $path = $request->path();

        foreach ($this->excludedPaths as $pattern) {
            if (fnmatch($pattern, $path)) {
                return true;
            }
        }

        return false;
    }
}
