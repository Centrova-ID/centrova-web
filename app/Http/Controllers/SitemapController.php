<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * Display the sitemap page with automatically generated routes
     */
    public function index()
    {
        $sitemapData = $this->generateSitemapData();
        return view('home.sitemap', compact('sitemapData'));
    }

    /**
     * Generate XML sitemap — comprehensive, AI-ready, SEO-optimized
     * Only includes pages that have active routes registered.
     */
    public function xml()
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $now = Carbon::now();

        $sitemap = Sitemap::create();

        // Track all active routes for the centrova.id domain
        $activeRoutes = $this->getActiveRoutes();

        // ================================================================
        // 1. HOME (priority 1.0 — most important)
        // ================================================================
        $sitemap->add(Url::create($baseUrl)
            ->setLastModificationDate($now)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        // ================================================================
        // 2. CORE PAGES (priority 0.8)
        // Note: /search excluded — no SEO value, has noindex
        // ================================================================
        $corePages = [
            '/about'          => ['freq' => Url::CHANGE_FREQUENCY_MONTHLY, 'prio' => 0.8],
            '/contact'        => ['freq' => Url::CHANGE_FREQUENCY_MONTHLY, 'prio' => 0.8],
            '/blog'           => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.8],
            '/sitemap'        => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.5],
        ];

        foreach ($corePages as $path => $meta) {
            if (in_array($path, $activeRoutes)) {
                $sitemap->add(Url::create($baseUrl . $path)
                    ->setLastModificationDate($now)
                    ->setChangeFrequency($meta['freq'])
                    ->setPriority($meta['prio']));
            }
        }

        // ================================================================
        // 3. SERVICES PAGES (priority 0.9 — high commercial value)
        // Only canonical URLs — short-form aliases redirected via 301
        // ================================================================
        $servicePages = [
            '/services'                     => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/services/web-development'     => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/services/app-development'     => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/services/mobile-app-development' => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/services/uiux-design'         => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/services/custom-solution'     => ['freq' => Url::CHANGE_FREQUENCY_MONTHLY, 'prio' => 0.9],
            '/services/ai/ai-strategy'      => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/services/ai/ai-agents'        => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/services/ai/ai-automation'    => ['freq' => Url::CHANGE_FREQUENCY_WEEKLY,  'prio' => 0.9],
            '/service/consult'              => ['freq' => Url::CHANGE_FREQUENCY_MONTHLY, 'prio' => 0.9],
        ];

        foreach ($servicePages as $path => $meta) {
            if (in_array($path, $activeRoutes)) {
                $sitemap->add(Url::create($baseUrl . $path)
                    ->setLastModificationDate($now)
                    ->setChangeFrequency($meta['freq'])
                    ->setPriority($meta['prio']));
            }
        }

        // ================================================================
        // 4. ADD DYNAMIC CONTENT FROM MODELS (if available)
        // ================================================================
        $this->addDynamicContent($sitemap, $baseUrl, $now);

        return response($sitemap->render(), 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Get all active GET route URIs for the centrova.id domain.
     */
    private function getActiveRoutes(): array
    {
        $routes = Route::getRoutes();
        $active = [];

        foreach ($routes as $route) {
            $methods = $route->methods();
            $domain = $route->getDomain();
            $uri = '/' . $route->uri();

            // Only include GET routes
            if (!in_array('GET', $methods)) {
                continue;
            }

            // Only include centrova.id domain routes
            if ($domain && !str_contains($domain, 'centrova.id')) {
                continue;
            }

            // Skip routes with URI parameters ({slug}, {page}, etc.)
            if (str_contains($uri, '{')) {
                continue;
            }

            // Skip API, admin, auth, and other non-public routes
            $skipPatterns = [
                '/api/', '/admin', '/staff', '/chat', '/logout',
                '/dashboard', '/profile', '/settings', '/verify',
                '/reset-password', '/password', '/confirm',
                '/callback', '/send', '/messages', '/close',
                '/office', '/_debugbar',
            ];

            $shouldSkip = false;
            foreach ($skipPatterns as $pattern) {
                if (str_starts_with($uri, $pattern)) {
                    $shouldSkip = true;
                    break;
                }
            }

            if ($shouldSkip) {
                continue;
            }

            // Skip POST-only routes
            $routeMethods = $route->methods();
            if (count($routeMethods) === 1 && $routeMethods[0] === 'POST') {
                continue;
            }

            $active[] = $uri;
        }

        return array_unique($active);
    }

    /**
     * Add dynamic content to sitemap from database models
     */
    private function addDynamicContent($sitemap, string $baseUrl, Carbon $now)
    {
        // --- Blog Posts ---
        if (class_exists('\App\Models\Post')) {
            try {
                $posts = \App\Models\Post::where('published', true)
                    ->orderBy('updated_at', 'desc')
                    ->take(500)
                    ->get();

                foreach ($posts as $post) {
                    $url = $baseUrl . '/blog/' . ($post->slug ?? $post->id);
                    $sitemap->add(
                        Url::create($url)
                            ->setLastModificationDate($post->updated_at ?? $now)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.7)
                    );
                }
            } catch (\Exception $e) {
                // Silently skip if table doesn't exist
            }
        }

        // --- Portfolio Items ---
        if (class_exists('\App\Models\Portfolio')) {
            try {
                $portfolios = \App\Models\Portfolio::where('published', true)
                    ->orderBy('updated_at', 'desc')
                    ->take(500)
                    ->get();

                foreach ($portfolios as $portfolio) {
                    $slug = $portfolio->slug ?? $portfolio->id;
                    $sitemap->add(
                        Url::create($baseUrl . '/services/web/' . $slug)
                            ->setLastModificationDate($portfolio->updated_at ?? $now)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority(0.6)
                    );
                }
            } catch (\Exception $e) {
                // Silently skip
            }
        }

        // --- Services (if dynamic model exists) ---
        if (class_exists('\App\Models\Service')) {
            try {
                $services = \App\Models\Service::where('active', true)
                    ->orderBy('updated_at', 'desc')
                    ->take(200)
                    ->get();

                foreach ($services as $service) {
                    $slug = $service->slug ?? $service->id;
                    $sitemap->add(
                        Url::create($baseUrl . '/services/' . $slug)
                            ->setLastModificationDate($service->updated_at ?? $now)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.8)
                    );
                }
            } catch (\Exception $e) {
                // Silently skip
            }
        }

        // --- News / Articles ---
        if (class_exists('\App\Models\Article')) {
            try {
                $articles = \App\Models\Article::where('published', true)
                    ->orderBy('updated_at', 'desc')
                    ->take(500)
                    ->get();

                foreach ($articles as $article) {
                    $slug = $article->slug ?? $article->id;
                    $sitemap->add(
                        Url::create($baseUrl . '/news/' . $slug)
                            ->setLastModificationDate($article->updated_at ?? $now)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.7)
                    );
                }
            } catch (\Exception $e) {
                // Silently skip
            }
        }

        // --- Case Studies ---
        if (class_exists('\App\Models\CaseStudy')) {
            try {
                $caseStudies = \App\Models\CaseStudy::where('status', 'published')
                    ->orderBy('updated_at', 'desc')
                    ->take(200)
                    ->get();

                foreach ($caseStudies as $cs) {
                    $sitemap->add(
                        Url::create($baseUrl . '/case-studies/' . ($cs->slug ?? $cs->id))
                            ->setLastModificationDate($cs->updated_at ?? $now)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority(0.7)
                    );
                }
            } catch (\Exception $e) {
                // Silently skip
            }
        }

        // --- Landing Pages (high commercial intent) ---
        if (class_exists('\App\Models\LandingPage')) {
            try {
                $landingPages = \App\Models\LandingPage::where('status', 'published')
                    ->orderBy('updated_at', 'desc')
                    ->take(100)
                    ->get();

                foreach ($landingPages as $lp) {
                    $sitemap->add(
                        Url::create($baseUrl . '/lp/' . ($lp->slug ?? $lp->id))
                            ->setLastModificationDate($lp->updated_at ?? $now)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority(0.9)
                    );
                }
            } catch (\Exception $e) {
                // Silently skip
            }
        }
    }

    /**
     * Generate sitemap data by analyzing available routes
     */
    private function generateSitemapData()
    {
        $routes = Route::getRoutes();
        $publicRoutes = [];
        
        // Define which domains and patterns should be included in sitemap
        $allowedDomains = [
            'centrova.id',
            'support.centrova.id',
            'news.centrova.id',
            'developer.centrova.id',
            'careers.centrova.id',
            'learn.centrova.id',
            'docs.centrova.id',
            'account.centrova.id'
        ];
        
        // Define excluded patterns (routes that shouldn't be in sitemap)
        $excludedPatterns = [
            '/api/',
            '/admin',
            '/staff',
            '/chat',
            '/logout',
            '/dashboard',
            '/profile',
            '/settings',
            '/{',
            '/verify',
            '/reset',
            '/password',
            '/confirm',
            '/callback',
            '/send',
            '/messages',
            '/close',
            '/search',        // No SEO value — has noindex
            '/search/',       // No SEO value — has noindex
        ];
        
        // Define route names that should be excluded
        $excludedNames = [
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'verification.notice',
            'verification.verify',
            'verification.send',
            'password.confirm',
            'logout'
        ];
        
        foreach ($routes as $route) {
            $uri = $route->uri();
            $name = $route->getName();
            $domain = $route->getDomain();
            $methods = $route->methods();
            
            // Only include GET routes
            if (!in_array('GET', $methods)) {
                continue;
            }
            
            // Skip routes with excluded names
            if ($name && in_array($name, $excludedNames)) {
                continue;
            }
            
            // Skip routes that match excluded patterns
            $shouldExclude = false;
            foreach ($excludedPatterns as $pattern) {
                if (Str::contains($uri, $pattern)) {
                    $shouldExclude = true;
                    break;
                }
            }
            
            if ($shouldExclude) {
                continue;
            }
            
            // Only include routes from allowed domains or main domain (no specific domain)
            if ($domain && !in_array($domain, $allowedDomains)) {
                continue;
            }
            
            // Skip dynamic routes with parameters for now
            if (Str::contains($uri, '{') && Str::contains($uri, '}')) {
                // Only include specific dynamic routes we want to show
                if (!$this->isAllowedDynamicRoute($uri, $name)) {
                    continue;
                }
            }
            
            $publicRoutes[] = [
                'uri' => $uri === '/' ? '' : '/' . ltrim($uri, '/'),
                'name' => $name,
                'domain' => $domain ?: 'centrova.id',
                'title' => $this->generateRouteTitle($uri, $name)
            ];
        }
        
        return $this->organizeSitemapData($publicRoutes);
    }
    
    /**
     * Check if a dynamic route should be included
     */
    private function isAllowedDynamicRoute($uri, $name)
    {
        $allowedDynamicRoutes = [
            // 'team/{slug}' => [
            //     ['slug' => 'daffa', 'title' => 'Daffa'],
            //     ['slug' => 'sultan', 'title' => 'Sultan']
            // ]
        ];
        
        return isset($allowedDynamicRoutes[$uri]);
    }
    
    /**
     * Generate a user-friendly title for the route
     */
    private function generateRouteTitle($uri, $name)
    {
        // Custom titles for specific routes
        $customTitles = [
            '/' => 'Beranda',
            '/about' => 'Tentang',
            '/products' => 'Produk',
            '/contact' => 'Kontak',
            // '/team' => 'Tim Centrova',
            '/sitemap' => 'Peta Situs',
            '/search' => 'Pencarian',
            '/services' => 'Semua Layanan',
            '/services/web' => 'Web Development',
            '/services/app' => 'App Development', 
            '/services/mobile-app' => 'Mobile App Development',
            '/services/uiux' => 'UI/UX Design',
            '/services/custom-solution' => 'Custom Solution',
            '/services/inquiry' => 'Konsultasi Layanan',
            '/legal' => 'Legalitas',
            '/legal/privacy' => 'Kebijakan Privasi',
            '/legal/terms' => 'Syarat & Ketentuan',
            '/legal/license' => 'Lisensi',
            '/legal/trademark' => 'Merek Dagang',
            '/legal/copyright' => 'Hak Cipta',
            '/legal/compliance' => 'Kepatuhan',
            '/legal/opensource' => 'Open Source',
            '/legal/cookies' => 'Kebijakan Cookie',
            '/legal/support-terms' => 'Syarat Dukungan',
            '/legal/retail-terms' => 'Syarat Retail',
            '/legal/disclaimer' => 'Disclaimer',
            '/help' => 'Bantuan',
            '/web/consult' => 'Konsultasi Web',
            '/services/web' => 'Layanan Web',
            '/services/app' => 'Layanan Aplikasi',
            '/services/mobile' => 'Layanan Mobile',
            '/services/uiux' => 'Layanan UI/UX',
            '/detail' => 'Detail Berita',
            '/editor' => 'Editor Berita',
            '/ui-kit' => 'UI Kit Developer',
        ];
        
        $cleanUri = '/' . ltrim($uri, '/');
        
        if (isset($customTitles[$cleanUri])) {
            return $customTitles[$cleanUri];
        }
        
        // Generate title from URI
        $segments = explode('/', trim($cleanUri, '/'));
        $lastSegment = end($segments);
        
        if (empty($lastSegment)) {
            return 'Beranda';
        }
        
        // Convert kebab-case to Title Case
        $title = str_replace(['-', '_'], ' ', $lastSegment);
        return Str::title($title);
    }
    
    /**
     * Organize sitemap data into categories
     */
    private function organizeSitemapData($routes)
    {
        $organized = [
            'centrova.id' => [
                'Utama' => [],
                'Layanan' => [],
                'Tim & Lainnya' => [],
                'Legal' => []
            ],
            'support.centrova.id' => [
                'Support' => []
            ],
            'news.centrova.id' => [
                'News' => []
            ],
            'developer.centrova.id' => [
                'Developer' => []
            ],
            'careers.centrova.id' => [
                'Karier' => []
            ],
            'learn.centrova.id' => [
                'Pembelajaran' => []
            ],
            'docs.centrova.id' => [
                'Dokumentasi' => []
            ],
            'account.centrova.id' => [
                'Akun' => []
            ]
        ];
        
        foreach ($routes as $route) {
            $domain = $route['domain'];
            $uri = $route['uri'];
            
            if (!isset($organized[$domain])) {
                continue;
            }
            
            // Categorize routes based on URI patterns
            if ($domain === 'centrova.id') {
                if (Str::startsWith($uri, '/services')) {
                    $organized[$domain]['Layanan'][] = $route;
                } elseif (Str::startsWith($uri, '/legal')) {
                    $organized[$domain]['Legal'][] = $route;
                } elseif (Str::startsWith($uri, '/team')) {
                    // Removed - team route disabled
                    continue;
                } else {
                    $organized[$domain]['Utama'][] = $route;
                }
            } else {
                // For subdomains, use the first category available
                $firstCategory = array_keys($organized[$domain])[0];
                $organized[$domain][$firstCategory][] = $route;
            }
        }
        
        // Remove empty categories
        foreach ($organized as $domain => $categories) {
            foreach ($categories as $category => $routes) {
                if (empty($routes)) {
                    unset($organized[$domain][$category]);
                }
            }
            if (empty($organized[$domain])) {
                unset($organized[$domain]);
            }
        }
        
        return $organized;
    }
}
