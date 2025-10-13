<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SEOHelper
{
    /**
     * Cache SEO data for better performance
     */
    public static function cacheSEOData(string $key, $data, int $minutes = 60)
    {
        return Cache::remember("seo.{$key}", $minutes * 60, function() use ($data) {
            return is_callable($data) ? $data() : $data;
        });
    }

    /**
     * Get optimized image URL with WebP support
     */
    public static function getOptimizedImageUrl(string $imagePath, int $width = null, int $height = null): string
    {
        $baseUrl = asset($imagePath);
        
        // If image optimization service is available, use it
        if (config('app.image_optimization_enabled')) {
            $params = [];
            if ($width) $params['w'] = $width;
            if ($height) $params['h'] = $height;
            $params['f'] = 'webp'; // Force WebP format
            $params['q'] = '85'; // Quality
            
            $queryString = http_build_query($params);
            return $baseUrl . ($queryString ? '?' . $queryString : '');
        }
        
        return $baseUrl;
    }

    /**
     * Generate meta keywords from text content
     */
    public static function generateKeywords(string $content, int $limit = 10): array
    {
        // Remove HTML tags and special characters
        $text = strip_tags($content);
        $text = preg_replace('/[^a-zA-Z0-9\s]/', '', $text);
        
        // Convert to lowercase and split into words
        $words = str_word_count(strtolower($text), 1);
        
        // Remove common words (stopwords)
        $stopwords = [
            'dan', 'atau', 'yang', 'ini', 'itu', 'dari', 'untuk', 'dengan', 'pada', 'adalah',
            'akan', 'dapat', 'telah', 'sudah', 'belum', 'juga', 'hanya', 'tidak', 'bisa',
            'the', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by'
        ];
        
        $filteredWords = array_filter($words, function($word) use ($stopwords) {
            return strlen($word) > 3 && !in_array($word, $stopwords);
        });
        
        // Count word frequency
        $wordCounts = array_count_values($filteredWords);
        
        // Sort by frequency and get top keywords
        arsort($wordCounts);
        
        return array_slice(array_keys($wordCounts), 0, $limit);
    }

    /**
     * Get social media sharing URLs
     */
    public static function getSocialShareUrls(string $url, string $title, string $description = ''): array
    {
        $encodedUrl = urlencode($url);
        $encodedTitle = urlencode($title);
        $encodedDescription = urlencode($description);
        
        return [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$encodedUrl}",
            'twitter' => "https://twitter.com/intent/tweet?url={$encodedUrl}&text={$encodedTitle}",
            'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url={$encodedUrl}",
            'whatsapp' => "https://wa.me/?text={$encodedTitle}%20{$encodedUrl}",
            'telegram' => "https://t.me/share/url?url={$encodedUrl}&text={$encodedTitle}",
            'email' => "mailto:?subject={$encodedTitle}&body={$encodedDescription}%0D%0A%0D%0A{$encodedUrl}"
        ];
    }

    /**
     * Generate structured data for breadcrumbs
     */
    public static function generateBreadcrumbStructuredData(array $breadcrumbs): string
    {
        $itemListElement = [];
        
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url']
            ];
        }

        $breadcrumbList = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement
        ];

        return json_encode($breadcrumbList, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Check if current page is being crawled by search engines
     */
    public static function isSearchEngineCrawler(): bool
    {
        $userAgent = request()->userAgent() ?? '';
        
        $crawlers = [
            'Googlebot', 'Bingbot', 'Slurp', 'DuckDuckBot', 'Baiduspider',
            'YandexBot', 'facebookexternalhit', 'Twitterbot', 'LinkedInBot'
        ];
        
        foreach ($crawlers as $crawler) {
            if (stripos($userAgent, $crawler) !== false) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Get page loading speed optimization hints
     */
    public static function getPerformanceHints(): array
    {
        return [
            'dns_prefetch' => [
                '//fonts.googleapis.com',
                '//unpkg.com',
                '//cdn.jsdelivr.net',
                '//cdnjs.cloudflare.com'
            ],
            'preconnect' => [
                'https://fonts.gstatic.com'
            ],
            'critical_css' => true,
            'lazy_loading' => true,
            'image_optimization' => true,
            'minification' => true,
            'gzip_compression' => true
        ];
    }

    /**
     * Generate robots meta tag based on page type
     */
    public static function getRobotsMetaTag(string $pageType = 'public'): string
    {
        $robotsMap = [
            'public' => 'index,follow',
            'private' => 'noindex,nofollow',
            'admin' => 'noindex,nofollow',
            'draft' => 'noindex,follow',
            'archive' => 'index,nofollow',
            'pagination' => 'noindex,follow'
        ];
        
        return $robotsMap[$pageType] ?? 'index,follow';
    }
}