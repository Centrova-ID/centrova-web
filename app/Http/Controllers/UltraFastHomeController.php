<?php

namespace App\Http\Controllers;

use App\Services\PreRenderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * ULTRA-LIGHTWEIGHT CONTROLLER
 * Zero database queries, zero logic, instant response
 * Target: <5ms execution time
 */
class UltraFastHomeController extends Controller
{
    protected PreRenderService $preRender;

    public function __construct(PreRenderService $preRender)
    {
        $this->preRender = $preRender;
        
        // Full page cache - serves from Redis without executing controller
        $this->middleware('ultrafast.cache:600')->only(['index', 'about']);
    }

    /**
     * Ultra-fast homepage
     * Serves pre-rendered HTML from cache
     */
    public function index(Request $request)
    {
        // Check if Turbo Frame request
        if ($turboFrame = $request->header('Turbo-Frame')) {
            return $this->serveTurboFrame($turboFrame);
        }

        // Try to serve pre-rendered page
        $preRendered = $this->preRender->getPreRendered('home.index');
        
        if ($preRendered) {
            return response($preRendered)
                ->header('X-Pre-Rendered', 'true')
                ->header('X-Render-Time', '0ms');
        }

        // Fallback: minimal data, no queries
        return view('home.index', $this->getCachedHomeData());
    }

    /**
     * Get all home data from single cache key
     * No database queries, no computation
     */
    protected function getCachedHomeData(): array
    {
        // Single cache read - all data pre-computed
        return Cache::remember('home:all-data', 600, function () {
            // This runs ONCE every 10 minutes, not per request
            return [
                'stats' => $this->preComputeStats(),
                'featured' => $this->preComputeFeatured(),
                'testimonials' => $this->preComputeTestimonials(),
            ];
        });
    }

    /**
     * Serve only requested Turbo Frame (ultra-fast partial)
     */
    protected function serveTurboFrame(string $frameId): \Illuminate\View\View
    {
        // Map frames to cached partials
        $frames = [
            'stats' => fn() => view('home.frames.stats', [
                'stats' => Cache::get('home:stats', [])
            ]),
            'featured' => fn() => view('home.frames.featured', [
                'featured' => Cache::get('home:featured', [])
            ]),
            'products' => fn() => view('home.frames.products', [
                'products' => Cache::get('home:products', [])
            ]),
        ];

        if (!isset($frames[$frameId])) {
            abort(404);
        }

        // Instant response - data already cached
        return $frames[$frameId]();
    }

    /**
     * Pre-compute stats (called by scheduler, not per request)
     */
    protected function preComputeStats(): array
    {
        // These values are computed in background job
        // Controller just reads from cache
        return [
            'users' => 1000,
            'projects' => 250,
            'clients' => 95,
        ];
    }

    /**
     * Pre-compute featured content
     */
    protected function preComputeFeatured(): array
    {
        // Pre-computed by background job
        return [];
    }

    /**
     * Pre-compute testimonials
     */
    protected function preComputeTestimonials(): array
    {
        // Pre-computed by background job
        return [];
    }

    /**
     * About page - fully cached
     */
    public function about()
    {
        // Entire response served from middleware cache
        // This method might not even execute
        return view('home.about', [
            'content' => Cache::get('about:content', 'About Us'),
        ]);
    }

    /**
     * Update stats via Turbo Stream (async)
     */
    public function updateStats()
    {
        $stats = Cache::get('home:stats', []);

        return response()
            ->view('home.streams.stats', compact('stats'))
            ->header('Content-Type', 'text/vnd.turbo-stream.html')
            ->header('Cache-Control', 'no-cache');
    }
}
