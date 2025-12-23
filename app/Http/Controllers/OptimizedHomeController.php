<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CacheService;
use App\Services\SEOService;

/**
 * Optimized Home Controller
 * Implements aggressive caching and Turbo-compatible responses
 */
class OptimizedHomeController extends Controller
{
    protected $cacheService;
    protected $seoService;

    public function __construct(CacheService $cacheService, SEOService $seoService)
    {
        $this->cacheService = $cacheService;
        $this->seoService = $seoService;
        
        // Apply performance cache middleware
        $this->middleware('performance.cache:300')->only(['index', 'products']);
    }

    /**
     * Show the application homepage with caching
     */
    public function index(Request $request)
    {
        // Set SEO
        $this->seoService->setHomepageSEO();

        // Check if this is a Turbo Frame request
        $turboFrame = $request->header('Turbo-Frame');

        if ($turboFrame) {
            // Return only the requested frame
            return $this->renderTurboFrame($turboFrame);
        }

        // Cache the view data
        $data = $this->cacheService->remember('home.index.data', 600, function () {
            return [
                'user' => auth()->user(),
                'stats' => $this->getStats(),
                'featured' => $this->getFeaturedContent(),
            ];
        });

        return view('home.index', $data);
    }

    /**
     * Show products page with fragment caching
     */
    public function products()
    {
        $this->seoService->setPageSEO([
            'title' => 'Produk & Layanan | Centrova',
            'description' => 'Jelajahi berbagai produk dan layanan teknologi terbaik dari Centrova.',
            'keywords' => ['produk centrova', 'layanan teknologi', 'web development']
        ]);

        // Cache products data
        $products = $this->cacheService->rememberQuery(
            'products.all',
            900,
            function () {
                // Replace with actual query
                return collect([
                    ['id' => 1, 'name' => 'Web Development', 'price' => 5000000],
                    ['id' => 2, 'name' => 'Domain', 'price' => 150000],
                    ['id' => 3, 'name' => 'Hosting', 'price' => 50000],
                ]);
            },
            ['products']
        );

        return view('home.products.index', [
            'user' => auth()->user(),
            'products' => $products,
        ]);
    }

    /**
     * Handle Turbo Stream updates
     */
    public function updateStats(Request $request)
    {
        $stats = $this->getStats();

        // Return Turbo Stream response
        return response()
            ->view('home.partials.stats-stream', ['stats' => $stats])
            ->header('Content-Type', 'text/vnd.turbo-stream.html');
    }

    /**
     * Get cached statistics
     */
    protected function getStats()
    {
        return $this->cacheService->remember('home.stats', 300, function () {
            return [
                'users' => 1000,
                'projects' => 250,
                'satisfied_clients' => 95,
            ];
        });
    }

    /**
     * Get featured content
     */
    protected function getFeaturedContent()
    {
        return $this->cacheService->rememberFragment('home.featured', 600, function () {
            // Replace with actual featured content logic
            return collect([
                ['title' => 'New Product Launch', 'image' => '/images/featured-1.jpg'],
                ['title' => 'Special Offer', 'image' => '/images/featured-2.jpg'],
            ]);
        });
    }

    /**
     * Render specific Turbo Frame
     */
    protected function renderTurboFrame(string $frameId)
    {
        // Map frame IDs to partial views
        $frames = [
            'stats' => 'home.partials.stats',
            'featured' => 'home.partials.featured',
            'products' => 'home.partials.products',
        ];

        if (!isset($frames[$frameId])) {
            abort(404, 'Frame not found');
        }

        $data = $this->cacheService->remember("frame.{$frameId}", 300, function () use ($frameId) {
            switch ($frameId) {
                case 'stats':
                    return ['stats' => $this->getStats()];
                case 'featured':
                    return ['featured' => $this->getFeaturedContent()];
                default:
                    return [];
            }
        });

        return view($frames[$frameId], $data);
    }
}
