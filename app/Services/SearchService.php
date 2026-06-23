<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class SearchService
{
    protected $webContentIndexer;
    protected $searchablePages = [];

    public function __construct(WebContentIndexer $webContentIndexer)
    {
        $this->webContentIndexer = $webContentIndexer;
        $this->initializeSearchablePages();
    }

    protected function initializeSearchablePages()
    {
        $locale = app()->getLocale();
        
        $this->searchablePages = [
            // Home Pages
            [
                'title' => __('app.home') . ' - Centrova',
                'description' => $locale === 'id' 
                    ? 'Halaman utama Centrova, penyedia solusi teknologi terdepan untuk bisnis Anda.'
                    : 'Centrova main page, leading technology solutions provider for your business.',
                'content' => $locale === 'id'
                    ? 'Selamat datang di Centrova, perusahaan teknologi digital yang menyediakan solusi lengkap untuk bisnis modern. Kami mengkhususkan diri dalam pengembangan website, aplikasi mobile, dan desain UI/UX yang inovatif. Tim profesional kami siap membantu mengembangkan proyek personal maupun enterprise dengan teknologi terkini.'
                    : 'Welcome to Centrova, a digital technology company that provides complete solutions for modern businesses. We specialize in innovative website development, mobile applications, and UI/UX design. Our professional team is ready to help develop personal and enterprise projects with the latest technology.',
                'url' => localizedRoute('home'),
                'type' => $locale === 'id' ? 'Halaman Utama' : 'Main Page',
                'category' => 'general',
                'keywords' => $locale === 'id' 
                    ? ['home', 'beranda', 'utama', 'centrova', 'teknologi', 'digital', 'personal', 'portfolio', 'professional']
                    : ['home', 'main', 'centrova', 'technology', 'digital', 'personal', 'portfolio', 'professional']
            ],
            [
                'title' => __('app.about') . ' - Centrova',
                'description' => $locale === 'id'
                    ? 'Pelajari lebih lanjut tentang Centrova, visi, misi, dan tim profesional kami.'
                    : 'Learn more about Centrova, our vision, mission, and professional team.',
                'content' => $locale === 'id'
                    ? 'Centrova adalah perusahaan teknologi yang didirikan dengan visi untuk memberikan solusi digital terbaik. Tim profesional kami terdiri dari developer berpengalaman, designer kreatif, dan konsultan bisnis yang siap membantu mengembangkan bisnis Anda. Kami melayani proyek personal, startup, hingga enterprise dengan pendekatan yang inovatif dan modern.'
                    : 'Centrova is a technology company founded with the vision to provide the best digital solutions. Our professional team consists of experienced developers, creative designers, and business consultants ready to help develop your business. We serve personal, startup, and enterprise projects with innovative and modern approaches.',
                'url' => localizedRoute('about'),
                'type' => $locale === 'id' ? 'Informasi' : 'Information',
                'category' => 'company',
                'keywords' => $locale === 'id'
                    ? ['tentang', 'about', 'kami', 'visi', 'misi', 'tim', 'team', 'personal', 'profile', 'background']
                    : ['about', 'us', 'vision', 'mission', 'team', 'personal', 'profile', 'background']
            ],
            [
                'title' => __('app.contact') . ' - ' . __('app.contact_us'),
                'description' => $locale === 'id'
                    ? 'Hubungi tim Centrova untuk konsultasi gratis dan diskusi proyek Anda.'
                    : 'Contact Centrova team for free consultation and project discussion.',
                'content' => $locale === 'id'
                    ? 'Hubungi kami untuk konsultasi gratis tentang kebutuhan teknologi bisnis Anda. Tim support kami siap membantu melalui berbagai channel komunikasi untuk proyek personal maupun enterprise.'
                    : 'Contact us for free consultation about your business technology needs. Our support team is ready to help through various communication channels for personal and enterprise projects.',
                'url' => localizedRoute('contact'),
                'type' => $locale === 'id' ? 'Kontak' : 'Contact',
                'category' => 'contact',
                'keywords' => $locale === 'id'
                    ? ['kontak', 'contact', 'hubungi', 'konsultasi', 'alamat', 'telepon', 'email']
                    : ['contact', 'consultation', 'address', 'phone', 'email', 'support']
            ],

            // Service Pages
            [
                'title' => 'Layanan - Semua Solusi Teknologi',
                'description' => 'Jelajahi semua layanan teknologi yang kami tawarkan untuk mengembangkan bisnis Anda.',
                'content' => 'Kami menyediakan berbagai layanan teknologi lengkap mulai dari pembuatan website, pengembangan aplikasi mobile, desain UI/UX, hingga digital marketing untuk membantu mengembangkan bisnis Anda secara online.',
                'url' => route('services.index'),
                'type' => 'Layanan',
                'category' => 'services',
                'keywords' => ['layanan', 'services', 'teknologi', 'solusi', 'bisnis']
            ],
            [
                'title' => 'Jasa Pembuatan Website Profesional',
                'description' => 'Layanan pembuatan website profesional, responsif, dan SEO-friendly untuk bisnis Anda.',
                'content' => 'Jasa pembuatan website profesional dengan teknologi terkini. Kami membuat website responsif, cepat, dan SEO-friendly menggunakan framework modern seperti Laravel, React, dan WordPress. Cocok untuk website personal, portfolio, company profile, e-commerce, dan aplikasi web enterprise.',
                'url' => route('services.web-development'),
                'type' => 'Layanan',
                'category' => 'services',
                'keywords' => ['website', 'web', 'development', 'pembuatan', 'profesional', 'responsif', 'seo', 'cms', 'personal', 'portfolio', 'company', 'corporate']
            ],
            [
                'title' => 'Mobile App Development - iOS & Android',
                'description' => 'Pengembangan aplikasi mobile native dan hybrid untuk platform iOS dan Android.',
                'content' => 'Layanan pengembangan aplikasi mobile untuk iOS dan Android. Kami menggunakan teknologi native (Swift, Kotlin) dan cross-platform (Flutter, React Native) untuk menghasilkan aplikasi yang optimal dan performa tinggi. Melayani proyek personal, business, dan enterprise.',
                'url' => route('services.mobile-app-development'),
                'type' => 'Layanan',
                'category' => 'services',
                'keywords' => ['mobile', 'app', 'aplikasi', 'ios', 'android', 'native', 'hybrid', 'flutter', 'personal', 'business', 'corporate']
            ],
            [
                'title' => 'UI/UX Design - Pengalaman Pengguna Optimal',
                'description' => 'Desain antarmuka dan pengalaman pengguna yang menarik dan user-friendly.',
                'content' => 'ui ux design desain antarmuka user interface experience pengguna optimal figma adobe xd sketch prototype wireframe',
                'url' => route('services.uiux-design'),
                'type' => 'Layanan',
                'category' => 'services',
                'keywords' => ['ui', 'ux', 'design', 'desain', 'antarmuka', 'pengguna', 'figma', 'prototype']
            ],
            [
                'title' => 'Solusi Custom - Teknologi Khusus',
                'description' => 'Pengembangan solusi teknologi custom sesuai kebutuhan spesifik bisnis Anda.',
                'content' => 'custom solution solusi khusus teknologi spesifik bisnis enterprise api integration sistem informasi',
                'url' => route('services.custom-solution.index'),
                'type' => 'Layanan',
                'category' => 'services',
                'keywords' => ['custom', 'solusi', 'khusus', 'spesifik', 'enterprise', 'api', 'sistem']
            ],

            // Legal Pages
            [
                'title' => 'Informasi Legal - Kebijakan & Ketentuan',
                'description' => 'Kumpulan dokumen legal, kebijakan privasi, syarat layanan, dan informasi hukum.',
                'content' => 'legal hukum kebijakan policy privacy privasi terms ketentuan layanan disclaimer copyright',
                'url' => route('legal.index'),
                'type' => 'Legal',
                'category' => 'legal',
                'keywords' => ['legal', 'hukum', 'kebijakan', 'privacy', 'terms', 'ketentuan']
            ],
            [
                'title' => 'Kebijakan Privasi',
                'description' => 'Informasi lengkap tentang bagaimana kami melindungi dan mengelola data pribadi Anda.',
                'content' => 'kebijakan privasi privacy policy data pribadi perlindungan keamanan informasi gdpr',
                'url' => route('legal.privacy'),
                'type' => 'Legal',
                'category' => 'legal',
                'keywords' => ['privasi', 'privacy', 'data', 'pribadi', 'perlindungan', 'keamanan']
            ],
            [
                'title' => 'Syarat & Ketentuan Layanan',
                'description' => 'Syarat dan ketentuan penggunaan layanan Centrova yang harus dipatuhi pengguna.',
                'content' => 'syarat ketentuan terms conditions layanan service penggunaan aturan hak kewajiban',
                'url' => route('legal.terms'),
                'type' => 'Legal',
                'category' => 'legal',
                'keywords' => ['syarat', 'ketentuan', 'terms', 'conditions', 'layanan', 'aturan']
            ],

            // Support Pages
            [
                'title' => 'Pusat Bantuan - Support Center',
                'description' => 'Dapatkan bantuan teknis, konsultasi, dan dukungan untuk semua layanan Centrova.',
                'content' => 'bantuan help support center konsultasi teknis dukungan chat live chat dokumentasi FAQ',
                'url' => route('support.home'),
                'type' => 'Bantuan',
                'category' => 'support',
                'keywords' => ['bantuan', 'help', 'support', 'konsultasi', 'teknis', 'chat', 'faq']
            ],

            // Additional Personal/Portfolio Pages
            [
                'title' => 'Portfolio & Personal Projects',
                'description' => 'Lihat portfolio dan proyek personal yang telah kami kerjakan dengan berbagai klien.',
                'content' => 'portfolio personal projects proyek karya showcase gallery work samples case study client testimonial creative design development website mobile app ui ux graphic brand identity logo corporate business startup freelance consultant agency professional modern innovative',
                'url' => route('home'),
                'type' => 'Portfolio',
                'category' => 'portfolio',
                'keywords' => ['portfolio', 'personal', 'projects', 'proyek', 'showcase', 'gallery', 'work', 'samples', 'case study']
            ],

            // Additional Legal Pages
            [
                'title' => 'Kebijakan Cookie',
                'description' => 'Informasi tentang penggunaan cookie di website Centrova.',
                'content' => 'cookie kebijakan policy cookies tracking website browser data',
                'url' => route('legal.cookies'),
                'type' => 'Legal',
                'category' => 'legal',
                'keywords' => ['cookie', 'cookies', 'kebijakan', 'tracking', 'browser']
            ],
            [
                'title' => 'Disclaimer & Penafian',
                'description' => 'Penafian dan batasan tanggung jawab layanan Centrova.',
                'content' => 'disclaimer penafian tanggung jawab disclaimer liability batasan layanan',
                'url' => route('legal.disclaimer'),
                'type' => 'Legal',
                'category' => 'legal',
                'keywords' => ['disclaimer', 'penafian', 'tanggung jawab', 'liability', 'batasan']
            ],

            // Additional Service Pages  
            [
                'title' => 'Digital Marketing & SEO',
                'description' => 'Layanan digital marketing dan optimisasi SEO untuk meningkatkan visibilitas bisnis online.',
                'content' => 'digital marketing seo search engine optimization google ads facebook ads social media marketing online advertising',
                'url' => route('services.index'),
                'type' => 'Layanan',
                'category' => 'services',
                'keywords' => ['digital', 'marketing', 'seo', 'google', 'ads', 'social media', 'advertising']
            ],
            [
                'title' => 'Konsultasi Gratis',
                'description' => 'Dapatkan konsultasi gratis untuk menentukan solusi teknologi terbaik bagi bisnis Anda.',
                'content' => 'konsultasi gratis free consultation teknologi bisnis advice saran expert consultation meeting',
                'url' => route('contact'),
                'type' => 'Konsultasi',
                'category' => 'services',
                'keywords' => ['konsultasi', 'gratis', 'free', 'consultation', 'advice', 'saran', 'meeting']
            ],

            // Documentation and Help Pages
            [
                'title' => 'FAQ - Pertanyaan yang Sering Diajukan',
                'description' => 'Temukan jawaban untuk pertanyaan yang paling sering diajukan tentang layanan Centrova.',
                'content' => 'faq frequently asked questions pertanyaan sering diajukan help bantuan jawaban answer support',
                'url' => route('support.help.home'),
                'type' => 'Bantuan',
                'category' => 'support',
                'keywords' => ['faq', 'pertanyaan', 'jawaban', 'help', 'bantuan', 'sering', 'diajukan']
            ],
            [
                'title' => 'Portofolio & Karya Kami',
                'description' => 'Lihat kumpulan karya dan proyek yang telah berhasil kami selesaikan.',
                'content' => 'portofolio portfolio karya proyek project showcase hasil work case study client',
                'url' => route('home'),
                'type' => 'Portofolio',
                'category' => 'company',
                'keywords' => ['portofolio', 'portfolio', 'karya', 'proyek', 'project', 'showcase', 'case study']
            ],
            [
                'title' => 'Harga & Paket Layanan',
                'description' => 'Informasi lengkap tentang harga dan paket layanan yang tersedia.',
                'content' => 'harga price paket package layanan service pricing cost biaya tarif estimate',
                'url' => route('services.index'),
                'type' => 'Layanan',
                'category' => 'services',
                'keywords' => ['harga', 'price', 'paket', 'package', 'pricing', 'cost', 'biaya', 'tarif']
            ],
            [
                'title' => 'Karir & Lowongan Kerja',
                'description' => 'Bergabunglah dengan tim Centrova dan kembangkan karir di bidang teknologi.',
                'content' => 'karir career lowongan kerja job vacancy hiring join tim team work opportunity',
                'url' => '#',
                'type' => 'Karir',
                'category' => 'company',
                'keywords' => ['karir', 'career', 'lowongan', 'kerja', 'job', 'vacancy', 'hiring', 'opportunity']
            ]
        ];
    }

    public function search($query, $filters = [])
    {
        if (empty($query)) {
            return [];
        }

        // Try advanced content indexer first
        $indexedResults = $this->webContentIndexer->searchContent($query, $filters);
        
        // If we have good results from indexer, use them
        if (count($indexedResults) > 0) {
            return $indexedResults;
        }

        // Fallback to manual search
        return $this->manualSearch($query, $filters);
    }

    protected function manualSearch($query, $filters = [])
    {
        $results = [];
        $queryLower = strtolower(trim($query));
        $queryWords = explode(' ', $queryLower);

        foreach ($this->searchablePages as $page) {
            $score = $this->calculateRelevanceScore($page, $queryLower, $queryWords, $filters);
            
            if ($score > 0) {
                $page['score'] = $score;
                $page['highlighted_title'] = $this->highlightMatches($page['title'], $queryWords);
                $page['highlighted_description'] = $this->highlightMatches($page['description'], $queryWords);
                $page['excerpt'] = $this->createExcerpt($page['content'], $queryWords, 150);
                $results[] = $page;
            }
        }

        // Sort by relevance score (highest first)
        usort($results, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }

    protected function calculateRelevanceScore($page, $query, $queryWords, $filters = [])
    {
        $score = 0;

        // Apply category filter if specified
        if (!empty($filters['category']) && $page['category'] !== $filters['category']) {
            return 0;
        }

        // Check exact title match (highest score)
        if (str_contains(strtolower($page['title']), $query)) {
            $score += 100;
        }

        // Check exact description match
        if (str_contains(strtolower($page['description']), $query)) {
            $score += 80;
        }

        // Check keywords match
        foreach ($page['keywords'] as $keyword) {
            if (str_contains(strtolower($keyword), $query) || str_contains($query, strtolower($keyword))) {
                $score += 60;
            }
        }

        // Check content match
        if (str_contains(strtolower($page['content']), $query)) {
            $score += 40;
        }

        // Check individual word matches
        foreach ($queryWords as $word) {
            if (strlen($word) < 3) continue; // Skip very short words

            if (str_contains(strtolower($page['title']), $word)) {
                $score += 20;
            }
            if (str_contains(strtolower($page['description']), $word)) {
                $score += 15;
            }
            if (str_contains(strtolower($page['content']), $word)) {
                $score += 10;
            }
            foreach ($page['keywords'] as $keyword) {
                if (str_contains(strtolower($keyword), $word)) {
                    $score += 25;
                }
            }
        }

        return $score;
    }

    protected function highlightMatches($text, $queryWords)
    {
        $highlightedText = $text;
        
        foreach ($queryWords as $word) {
            if (strlen($word) < 3) continue;
            
            $pattern = '/(' . preg_quote($word, '/') . ')/i';
            $highlightedText = preg_replace($pattern, '<mark class="highlight">$1</mark>', $highlightedText);
        }
        
        return $highlightedText;
    }

    protected function createExcerpt($content, $queryWords, $maxLength = 150)
    {
        // If content is shorter than max length, return as is
        if (strlen($content) <= $maxLength) {
            return $this->highlightMatches($content, $queryWords);
        }

        // Try to find the first occurrence of any query word
        $bestPosition = 0;
        $queryLower = array_map('strtolower', $queryWords);
        $contentLower = strtolower($content);

        foreach ($queryLower as $word) {
            if (strlen($word) < 3) continue;
            $position = strpos($contentLower, $word);
            if ($position !== false) {
                // Start excerpt a bit before the found word
                $bestPosition = max(0, $position - 30);
                break;
            }
        }

        // Create excerpt starting from best position
        $excerpt = substr($content, $bestPosition, $maxLength);
        
        // Try to end at a word boundary
        if (strlen($content) > $bestPosition + $maxLength) {
            $lastSpace = strrpos($excerpt, ' ');
            if ($lastSpace && $lastSpace > $maxLength * 0.7) {
                $excerpt = substr($excerpt, 0, $lastSpace);
            }
            $excerpt .= '...';
        }

        // Add leading ellipsis if we started from middle
        if ($bestPosition > 0) {
            $excerpt = '...' . $excerpt;
        }

        return $this->highlightMatches($excerpt, $queryWords);
    }

    public function getSearchSuggestions()
    {
        return [
            'popular' => [
                'website', 'mobile app', 'ui ux design', 'digital marketing', 
                'konsultasi', 'pembuatan website', 'aplikasi mobile', 'desain'
            ],
            'categories' => [
                'services' => 'Layanan',
                'legal' => 'Legal',
                'support' => 'Bantuan',
                'company' => 'Perusahaan'
            ]
        ];
    }

    public function getQuickLinks()
    {
        return [
            [
                'title' => 'Website Development',
                'description' => 'Pembuatan Website',
                'url' => route('services.web-development'),
                'icon' => 'globe'
            ],
            [
                'title' => 'Mobile App',
                'description' => 'Aplikasi Mobile',
                'url' => route('services.mobile-app-development'),
                'icon' => 'mobile'
            ],
            [
                'title' => 'UI/UX Design',
                'description' => 'Desain Interface',
                'url' => route('services.uiux-design'),
                'icon' => 'design'
            ],
            [
                'title' => 'Kontak',
                'description' => 'Hubungi Kami',
                'url' => route('contact'),
                'icon' => 'contact'
            ]
        ];
    }
}
