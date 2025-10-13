<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SEOService;
use Symfony\Component\HttpFoundation\Response;

class SEOMiddleware
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply SEO for web routes (not API or admin routes)
        if ($request->is('api/*') || $request->is('admin/*')) {
            return $next($request);
        }

        // Set default SEO based on current route
        $this->seoService->getRouteBasedSEO();

        // Add global structured data
        $this->addGlobalStructuredData();

        return $next($request);
    }

    /**
     * Add global structured data to all pages
     */
    protected function addGlobalStructuredData()
    {
        // Add Organization schema
        $organizationSchema = $this->seoService->addOrganizationSchema();
        
        // Add Website schema
        $websiteSchema = $this->seoService->addWebsiteSchema();

        // Share with view
        view()->share('organizationSchema', $organizationSchema);
        view()->share('websiteSchema', $websiteSchema);
    }
}
