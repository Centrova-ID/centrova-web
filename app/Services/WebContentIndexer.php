<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class WebContentIndexer
{
    protected $indexedContent = [];
    protected $viewPaths = [];
    
    public function __construct()
    {
        $this->viewPaths = [
            resource_path('views/home'),
            resource_path('views/services'),
            resource_path('views/legal'),
            resource_path('views/support'),
            resource_path('views/docs'),
        ];
    }

    public function indexAllContent()
    {
        $this->indexedContent = [];
        
        // Index static pages first
        $this->indexStaticPages();
        
        // Index view files
        $this->indexViewFiles();
        
        return $this->indexedContent;
    }

    protected function indexStaticPages()
    {
        $staticPages = [
            [
                'title' => 'Beranda - Centrova',
                'content' => 'beranda home centrova teknologi digital solusi bisnis website aplikasi mobile ui ux design development startup perusahaan modern professional innovative creative team expert developer designer marketing seo optimization responsive custom solution enterprise personal portfolio business corporate',
                'url' => route('home'),
                'type' => 'Halaman Utama',
                'category' => 'general'
            ],
            [
                'title' => 'Tentang Kami - About Centrova',
                'content' => 'tentang kami about us centrova company perusahaan teknologi digital visi misi tim team professional pengalaman experience expertise skill keahlian developer designer manager ceo founder startup business corporate personal profile background history',
                'url' => route('about'),
                'type' => 'Informasi Perusahaan',
                'category' => 'company'
            ],
            [
                'title' => 'Kontak - Hubungi Kami',
                'content' => 'kontak contact hubungi kami personal konsultasi gratis free consultation alamat address telepon phone email whatsapp chat support bantuan help customer service',
                'url' => route('contact'),
                'type' => 'Kontak',
                'category' => 'contact'
            ]
        ];

        foreach ($staticPages as $page) {
            $this->indexedContent[] = $page;
        }
    }

    protected function indexViewFiles()
    {
        foreach ($this->viewPaths as $path) {
            if (File::exists($path)) {
                $this->scanDirectory($path);
            }
        }
    }

    protected function scanDirectory($directory)
    {
        $files = File::allFiles($directory);
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $this->indexViewFile($file);
            }
        }
    }

    protected function indexViewFile($file)
    {
        $content = File::get($file->getPathname());
        $relativePath = str_replace(resource_path('views/'), '', $file->getPathname());
        $relativePath = str_replace('.blade.php', '', $relativePath);
        $relativePath = str_replace('\\', '.', $relativePath);
        
        // Extract text content from blade file
        $extractedText = $this->extractTextFromBlade($content);
        
        if (empty($extractedText)) {
            return;
        }

        // Generate URL from view path
        $url = $this->generateUrlFromViewPath($relativePath);
        
        if (!$url) {
            return;
        }

        // Extract title
        $title = $this->extractTitle($content) ?: $this->generateTitleFromPath($relativePath);
        
        // Determine category and type
        $category = $this->determineCategoryFromPath($relativePath);
        $type = $this->determineTypeFromPath($relativePath);

        $this->indexedContent[] = [
            'title' => $title,
            'content' => $extractedText,
            'url' => $url,
            'type' => $type,
            'category' => $category,
            'file_path' => $relativePath
        ];
    }

    protected function extractTextFromBlade($content)
    {
        // Remove JavaScript sections first
        $content = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $content);
        
        // Remove style sections
        $content = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/mi', '', $content);
        
        // Remove PHP code
        $content = preg_replace('/<\?php.*?\?>/s', '', $content);
        
        // Remove Blade directives more comprehensively
        $content = preg_replace('/@[a-zA-Z_]+(\([^)]*\))?/', '', $content);
        
        // Remove Blade echo statements
        $content = preg_replace('/\{\{.*?\}\}/s', '', $content);
        $content = preg_replace('/\{!!.*?!!\}/s', '', $content);
        
        // Remove common non-content patterns
        $content = preg_replace('/x-[a-zA-Z-]+\s*=\s*["\'][^"\']*["\']/', '', $content);
        $content = preg_replace('/class\s*=\s*["\'][^"\']*["\']/', '', $content);
        $content = preg_replace('/id\s*=\s*["\'][^"\']*["\']/', '', $content);
        
        // Remove HTML tags
        $content = strip_tags($content);
        
        // Remove common meaningless patterns
        $content = preg_replace('/[\'"][a-zA-Z_-]+[\'"]/', '', $content);
        $content = preg_replace('/\b(url|text|title|description|icon|type|category)\b/i', '', $content);
        
        // Clean up whitespace
        $content = preg_replace('/\s+/', ' ', $content);
        $content = trim($content);
        
        // Extract meaningful words (longer than 2 characters)
        $words = str_word_count($content, 1);
        $meaningfulWords = array_filter($words, function($word) {
            $wordLower = strtolower($word);
            return strlen($word) > 2 && 
                   !in_array($wordLower, [
                       'the', 'and', 'for', 'are', 'but', 'not', 'you', 'all', 'can', 'had', 'her', 'was', 'one', 'our', 'out', 'day', 'get', 'has', 'him', 'his', 'how', 'its', 'may', 'new', 'now', 'old', 'see', 'two', 'who', 'boy', 'did', 'she', 'use', 'way', 'what', 'when', 'where', 'will', 'with',
                       'var', 'let', 'const', 'function', 'return', 'true', 'false', 'null', 'undefined', 'console', 'log'
                   ]) &&
                   !preg_match('/^[a-f0-9]{6,}$/i', $word) && // hex colors
                   !is_numeric($word); // numbers
        });
        
        return implode(' ', $meaningfulWords);
    }

    protected function extractTitle($content)
    {
        // Try to extract title from @section('title')
        if (preg_match("/@section\s*\(\s*['\"]title['\"]\s*,\s*['\"]([^'\"]+)['\"]\s*\)/", $content, $matches)) {
            return $matches[1];
        }
        
        // Try to extract from <title> tag
        if (preg_match('/<title[^>]*>([^<]+)<\/title>/i', $content, $matches)) {
            return trim($matches[1]);
        }
        
        // Try to extract from h1 tag
        if (preg_match('/<h1[^>]*>([^<]+)<\/h1>/i', $content, $matches)) {
            return trim(strip_tags($matches[1]));
        }
        
        return null;
    }

    protected function generateTitleFromPath($path)
    {
        $parts = explode('.', $path);
        $title = end($parts);
        
        // Convert to readable format
        $title = str_replace(['-', '_'], ' ', $title);
        $title = ucwords($title);
        
        if ($title === 'Index') {
            array_pop($parts);
            if (!empty($parts)) {
                $title = ucwords(str_replace(['-', '_'], ' ', end($parts)));
            }
        }
        
        return $title;
    }

    protected function generateUrlFromViewPath($path)
    {
        // Map view paths to routes
        $routeMap = [
            'home.index' => 'home',
            'home.about' => 'about', 
            'home.contact' => 'contact',
            'home.search' => 'search',
            'home.team.index' => 'team.index',
            'services.index' => 'services.index',
            'services.web.index' => 'services.web.index',
            'services.app.index' => 'services.app.index',
            'services.mobile-app.index' => 'services.mobile-app.index',
            'services.uiux.index' => 'services.uiux.index',
            'services.custom-solution.index' => 'services.custom-solution.index',
            'legal.index' => 'legal.index',
            'legal.privacy' => 'legal.privacy',
            'legal.terms' => 'legal.terms',
            'legal.cookies' => 'legal.cookies',
            'legal.disclaimer' => 'legal.disclaimer',
            'legal.license' => 'legal.license',
            'legal.trademark' => 'legal.trademark',
            'legal.copyright' => 'legal.copyright',
            'legal.compliance' => 'legal.compliance',
            'legal.opensource' => 'legal.opensource',
            'legal.support-terms' => 'legal.support-terms',
            'legal.retail-terms' => 'legal.retail-terms',
            'support.index' => 'support.home',
            'support.help.index' => 'support.help.home',
            'support.services.index' => 'support.services.home',
        ];

        if (isset($routeMap[$path])) {
            try {
                return route($routeMap[$path]);
            } catch (\Exception $e) {
                return null;
            }
        }

        return null;
    }

    protected function determineCategoryFromPath($path)
    {
        if (str_starts_with($path, 'services')) return 'services';
        if (str_starts_with($path, 'legal')) return 'legal';
        if (str_starts_with($path, 'support')) return 'support';
        if (str_starts_with($path, 'home.team')) return 'team';
        if (str_starts_with($path, 'home')) return 'general';
        
        return 'other';
    }

    protected function determineTypeFromPath($path)
    {
        if (str_contains($path, 'services')) return 'Layanan';
        if (str_contains($path, 'legal')) return 'Legal';
        if (str_contains($path, 'support')) return 'Bantuan';
        if (str_contains($path, 'team')) return 'Tim';
        if (str_contains($path, 'about')) return 'Informasi';
        if (str_contains($path, 'contact')) return 'Kontak';
        
        return 'Halaman';
    }

    public function searchContent($query, $filters = [])
    {
        if (empty($this->indexedContent)) {
            $this->indexAllContent();
        }

        if (empty($query)) {
            return [];
        }

        $results = [];
        $queryLower = strtolower(trim($query));
        $queryWords = $this->tokenize($queryLower);

        foreach ($this->indexedContent as $page) {
            $score = $this->calculateAdvancedRelevanceScore($page, $queryLower, $queryWords, $filters);
            
            if ($score > 0) {
                $page['score'] = $score;
                $page['highlighted_title'] = $this->highlightMatches($page['title'], $queryWords);
                $page['highlighted_description'] = $this->generateDescription($page, $queryWords);
                $results[] = $page;
            }
        }

        // Sort by relevance score (highest first)
        usort($results, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }

    protected function tokenize($text)
    {
        // Split by spaces and remove short words
        $words = preg_split('/\s+/', $text);
        return array_filter($words, function($word) {
            return strlen($word) >= 2;
        });
    }

    protected function calculateAdvancedRelevanceScore($page, $query, $queryWords, $filters = [])
    {
        $score = 0;

        // Apply category filter
        if (!empty($filters['category']) && $page['category'] !== $filters['category']) {
            return 0;
        }

        $titleLower = strtolower($page['title']);
        $contentLower = strtolower($page['content']);

        // Exact phrase match (highest score)
        if (str_contains($titleLower, $query)) {
            $score += 150;
        }
        if (str_contains($contentLower, $query)) {
            $score += 100;
        }

        // Individual word matches
        foreach ($queryWords as $word) {
            if (strlen($word) < 2) continue;

            // Title matches (high weight)
            if (str_contains($titleLower, $word)) {
                $score += 50;
            }

            // Content matches with context
            $contentMatches = substr_count($contentLower, $word);
            $score += $contentMatches * 20;

            // Fuzzy matching for similar words
            $score += $this->getFuzzyMatchScore($word, $titleLower) * 30;
            $score += $this->getFuzzyMatchScore($word, $contentLower) * 15;
        }

        // Boost score for pages with multiple word matches
        $matchedWords = 0;
        foreach ($queryWords as $word) {
            if (str_contains($titleLower, $word) || str_contains($contentLower, $word)) {
                $matchedWords++;
            }
        }
        
        if ($matchedWords > 1) {
            $score += $matchedWords * 25;
        }

        // Category-specific boosts
        if ($page['category'] === 'services' && str_contains($query, 'layanan service')) {
            $score += 30;
        }

        return $score;
    }

    protected function getFuzzyMatchScore($needle, $haystack)
    {
        $score = 0;
        $needleLen = strlen($needle);
        
        if ($needleLen < 3) return 0;

        // Check for partial matches
        for ($i = 0; $i <= strlen($haystack) - $needleLen; $i++) {
            $substring = substr($haystack, $i, $needleLen);
            $similarity = 0;
            similar_text($needle, $substring, $similarity);
            
            if ($similarity > 80) { // 80% similarity threshold
                $score += $similarity / 100;
            }
        }

        return $score;
    }

    protected function highlightMatches($text, $queryWords)
    {
        $highlightedText = $text;
        
        foreach ($queryWords as $word) {
            if (strlen($word) < 2) continue;
            
            $pattern = '/(' . preg_quote($word, '/') . ')/i';
            $highlightedText = preg_replace($pattern, '<mark class="highlight">$1</mark>', $highlightedText);
        }
        
        return $highlightedText;
    }

    protected function generateDescription($page, $queryWords)
    {
        $content = $page['content'];
        
        // Clean content from any remaining artifacts
        $content = preg_replace('/\b(menuitems|layanan|keunggulan|konsultasi)\b/i', '', $content);
        $content = preg_replace('/[\'"][a-zA-Z_-]*[\'"]/', '', $content);
        $content = trim($content);
        
        // If content is too short or looks corrupted, use a default description
        if (strlen($content) < 20 || preg_match('/^[\s\'"]*$/', $content)) {
            return $this->getDefaultDescription($page);
        }
        
        // Find the best snippet containing query words
        $bestSnippet = $this->findBestSnippet($content, $queryWords);
        
        if ($bestSnippet) {
            return $this->highlightMatches($bestSnippet, $queryWords);
        }
        
        // Fallback to first 150 characters
        $excerpt = Str::limit($content, 150);
        
        // If excerpt still looks corrupted, use default description
        if (preg_match('/[\'"][a-zA-Z_-]*[\'"]/', $excerpt)) {
            return $this->getDefaultDescription($page);
        }
        
        return $this->highlightMatches($excerpt, $queryWords);
    }
    
    protected function getDefaultDescription($page)
    {
        $defaultDescriptions = [
            'services' => 'Layanan profesional untuk mengembangkan bisnis Anda dengan solusi teknologi terkini.',
            'legal' => 'Informasi legal dan kebijakan yang mengatur penggunaan layanan kami.',
            'support' => 'Bantuan dan dukungan untuk semua kebutuhan teknis Anda.',
            'team' => 'Tim profesional yang berpengalaman di bidang teknologi dan bisnis.',
            'general' => 'Informasi lengkap tentang layanan dan solusi yang kami tawarkan.'
        ];
        
        return $defaultDescriptions[$page['category']] ?? 'Temukan informasi yang Anda butuhkan di halaman ini.';
    }

    protected function findBestSnippet($content, $queryWords, $snippetLength = 200)
    {
        $words = explode(' ', $content);
        $bestScore = 0;
        $bestStart = 0;
        
        // Find the snippet with the most query word matches
        for ($i = 0; $i < count($words) - 20; $i++) {
            $snippet = implode(' ', array_slice($words, $i, 30));
            $score = 0;
            
            foreach ($queryWords as $queryWord) {
                $score += substr_count(strtolower($snippet), strtolower($queryWord));
            }
            
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestStart = $i;
            }
        }
        
        if ($bestScore > 0) {
            $snippet = implode(' ', array_slice($words, $bestStart, 30));
            return Str::limit($snippet, $snippetLength);
        }
        
        return null;
    }
}
