<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

/**
 * PRE-RENDERED RESPONSE SERVICE
 * Pre-compute and cache entire page responses
 * Target: 0ms render time (already rendered)
 */
class PreRenderService
{
    /**
     * Pre-render a view and store in cache
     */
    public function preRender(string $view, array $data = [], int $ttl = 3600): string
    {
        $cacheKey = $this->getPreRenderKey($view, $data);

        return Cache::remember($cacheKey, $ttl, function () use ($view, $data) {
            return View::make($view, $data)->render();
        });
    }

    /**
     * Pre-render multiple views in background
     */
    public function preRenderBatch(array $views): void
    {
        foreach ($views as $viewConfig) {
            $this->preRender(
                $viewConfig['view'],
                $viewConfig['data'] ?? [],
                $viewConfig['ttl'] ?? 3600
            );
        }
    }

    /**
     * Get pre-rendered content (instant response)
     */
    public function getPreRendered(string $view, array $data = []): ?string
    {
        $cacheKey = $this->getPreRenderKey($view, $data);
        return Cache::get($cacheKey);
    }

    /**
     * Pre-render on deployment
     */
    public function warmCriticalViews(): void
    {
        $criticalViews = [
            [
                'view' => 'home.index',
                'data' => $this->getHomeData(),
                'ttl' => 3600,
            ],
            [
                'view' => 'products.index',
                'data' => $this->getProductsData(),
                'ttl' => 1800,
            ],
            // Add more critical views
        ];

        $this->preRenderBatch($criticalViews);
    }

    /**
     * Generate cache key for pre-rendered view
     */
    protected function getPreRenderKey(string $view, array $data): string
    {
        // Create deterministic key based on view and data
        $dataHash = md5(serialize($this->normalizeData($data)));
        return "prerender:{$view}:{$dataHash}";
    }

    /**
     * Normalize data for consistent cache keys
     */
    protected function normalizeData(array $data): array
    {
        // Remove non-deterministic data
        unset($data['_token'], $data['timestamp']);
        ksort($data);
        return $data;
    }

    /**
     * Example: Get home page data
     */
    protected function getHomeData(): array
    {
        return Cache::remember('home.data', 600, function () {
            return [
                'stats' => [
                    'users' => 1000,
                    'projects' => 250,
                    'clients' => 95,
                ],
                'featured' => [],
            ];
        });
    }

    /**
     * Example: Get products data
     */
    protected function getProductsData(): array
    {
        return Cache::remember('products.data', 600, function () {
            return [
                'products' => [],
                'categories' => [],
            ];
        });
    }

    /**
     * Clear all pre-rendered cache
     */
    public function clearAll(): void
    {
        // If using tags
        Cache::tags(['prerender'])->flush();
    }

    /**
     * Clear specific pre-rendered view
     */
    public function clear(string $view, array $data = []): void
    {
        $cacheKey = $this->getPreRenderKey($view, $data);
        Cache::forget($cacheKey);
    }
}
