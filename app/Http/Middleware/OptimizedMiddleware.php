<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Optimized Middleware Stack
 * Reduces overhead by combining multiple checks
 */
class OptimizedMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add security headers
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Add performance headers
        if (config('performance.turbo.enabled')) {
            $response->headers->set('Turbo-Cache-Control', config('performance.turbo.cache_control'));
        }

        // Add ETag for conditional requests
        if (config('performance.turbo.etag') && $request->isMethod('GET')) {
            $etag = md5($response->getContent());
            $response->headers->set('ETag', $etag);

            // Check if client has cached version
            if ($request->header('If-None-Match') === $etag) {
                return response('', 304);
            }
        }

        // Add preload/prefetch headers
        if (config('performance.assets.preload')) {
            $this->addResourceHints($response);
        }

        return $response;
    }

    /**
     * Add resource hints for better performance
     */
    protected function addResourceHints(Response $response): void
    {
        $hints = [];

        // DNS Prefetch
        foreach (config('performance.assets.dns_prefetch', []) as $domain) {
            $hints[] = "<{$domain}>; rel=dns-prefetch";
        }

        // Preload critical assets
        if (config('performance.http2_push.enabled')) {
            foreach (config('performance.http2_push.resources', []) as $resource) {
                $type = $this->getResourceType($resource);
                $hints[] = "<{$resource}>; rel=preload; as={$type}";
            }
        }

        if (!empty($hints)) {
            $response->headers->set('Link', implode(', ', $hints));
        }
    }

    /**
     * Determine resource type for preload
     */
    protected function getResourceType(string $resource): string
    {
        if (str_ends_with($resource, '.css')) {
            return 'style';
        } elseif (str_ends_with($resource, '.js')) {
            return 'script';
        } elseif (preg_match('/\.(woff2?|ttf|otf|eot)$/', $resource)) {
            return 'font';
        } elseif (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/', $resource)) {
            return 'image';
        }

        return 'fetch';
    }
}
