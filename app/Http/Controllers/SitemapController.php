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
     * Generate XML sitemap
     */
    public function xml()
    {
        $sitemap = Sitemap::create();

        // Add static pages with priority and frequency
        $staticPages = [
            ['url' => '/', 'priority' => 1.0, 'changefreq' => 'daily'],
            ['url' => '/about', 'priority' => 0.8, 'changefreq' => 'monthly'],
            ['url' => '/services', 'priority' => 0.9, 'changefreq' => 'weekly'],
            ['url' => '/portfolio', 'priority' => 0.7, 'changefreq' => 'weekly'],
            ['url' => '/contact', 'priority' => 0.8, 'changefreq' => 'monthly'],
            ['url' => '/blog', 'priority' => 0.9, 'changefreq' => 'daily'],
            ['url' => '/pricing', 'priority' => 0.8, 'changefreq' => 'weekly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create(url($page['url']))
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency($page['changefreq'])
                    ->setPriority($page['priority'])
            );
        }

        // Add dynamic content (blog posts, services, etc.)
        $this->addDynamicContent($sitemap);

        return $sitemap->render();
    }

    /**
     * Add dynamic content to sitemap
     */
    private function addDynamicContent($sitemap)
    {
        // Add blog posts if you have a blog model
        // Example:
        /*
        if (class_exists('\App\Models\Post')) {
            $posts = \App\Models\Post::where('published', true)
                ->orderBy('updated_at', 'desc')
                ->get();
            
            foreach ($posts as $post) {
                $sitemap->add(
                    Url::create(route('blog.show', $post->slug))
                        ->setLastModificationDate($post->updated_at)
                        ->setChangeFrequency('monthly')
                        ->setPriority(0.6)
                );
            }
        }
        */

        // Add service pages if you have a service model
        /*
        if (class_exists('\App\Models\Service')) {
            $services = \App\Models\Service::where('active', true)->get();
            
            foreach ($services as $service) {
                $sitemap->add(
                    Url::create(route('services.show', $service->slug))
                        ->setLastModificationDate($service->updated_at)
                        ->setChangeFrequency('weekly')
                        ->setPriority(0.7)
                );
            }
        }
        */

        // Add portfolio items if you have a portfolio model
        /*
        if (class_exists('\App\Models\Portfolio')) {
            $portfolios = \App\Models\Portfolio::where('published', true)->get();
            
            foreach ($portfolios as $portfolio) {
                $sitemap->add(
                    Url::create(route('portfolio.show', $portfolio->slug))
                        ->setLastModificationDate($portfolio->updated_at)
                        ->setChangeFrequency('yearly')
                        ->setPriority(0.5)
                );
            }
        }
        */
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
            'centrova.test',
            'support.centrova.test',
            'news.centrova.test',
            'developer.centrova.test',
            'careers.centrova.test',
            'learn.centrova.test',
            'docs.centrova.test',
            'account.centrova.test'
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
            '/close'
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
                'domain' => $domain ?: 'centrova.test',
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
            'team/{slug}' => [
                ['slug' => 'daffa', 'title' => 'Daffa'],
                ['slug' => 'sultan', 'title' => 'Sultan']
            ]
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
            '/team' => 'Tim Centrova',
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
            'centrova.test' => [
                'Utama' => [],
                'Layanan' => [],
                'Tim & Lainnya' => [],
                'Legal' => []
            ],
            'support.centrova.test' => [
                'Support' => []
            ],
            'news.centrova.test' => [
                'News' => []
            ],
            'developer.centrova.test' => [
                'Developer' => []
            ],
            'careers.centrova.test' => [
                'Karier' => []
            ],
            'learn.centrova.test' => [
                'Pembelajaran' => []
            ],
            'docs.centrova.test' => [
                'Dokumentasi' => []
            ],
            'account.centrova.test' => [
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
            if ($domain === 'centrova.test') {
                if (Str::startsWith($uri, '/services')) {
                    $organized[$domain]['Layanan'][] = $route;
                } elseif (Str::startsWith($uri, '/legal')) {
                    $organized[$domain]['Legal'][] = $route;
                } elseif (Str::startsWith($uri, '/team')) {
                    $organized[$domain]['Tim & Lainnya'][] = $route;
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
