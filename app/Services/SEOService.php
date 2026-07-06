<?php

namespace App\Services;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Spatie\Tags\Tag;

class SEOService
{
    protected $defaultTitle;
    protected $defaultDescription;
    protected $defaultKeywords;
    protected $defaultImage;

    public function __construct()
    {
        $this->defaultTitle = config('app.name', 'Centrova');
        $this->defaultDescription = 'Centrova - Platform digital terdepan untuk solusi web development, hosting, dan layanan teknologi modern di Indonesia';
        $this->defaultKeywords = ['web development', 'hosting', 'domain', 'teknologi', 'digital solution', 'indonesia', 'centrova'];
        $this->defaultImage = asset('assets/images/centrova-og-image.jpg');
    }

    /**
     * Set SEO data for a page
     */
    public function setPageSEO(array $data = [])
    {
        $title = $data['title'] ?? $this->defaultTitle;
        $description = $data['description'] ?? $this->defaultDescription;
        $keywords = $data['keywords'] ?? $this->defaultKeywords;
        $image = $data['image'] ?? $this->defaultImage;
        $url = $data['url'] ?? URL::current();
        $type = $data['type'] ?? 'website';

        // Set Meta Tags
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);
        SEOMeta::setCanonical($url);
        SEOMeta::addMeta('robots', 'index,follow');
        SEOMeta::addMeta('author', 'Centrova');
        SEOMeta::addMeta('viewport', 'width=device-width, initial-scale=1');
        SEOMeta::addMeta('theme-color', '#2563eb');

        // Set Open Graph
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);
        OpenGraph::setType($type);
        OpenGraph::setSiteName(config('app.name'));
        OpenGraph::addImage($image, ['height' => 630, 'width' => 1200]);
        OpenGraph::addProperty('locale', 'id_ID');

        // Set Twitter Card
        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setUrl($url);
        TwitterCard::setImage($image);
        TwitterCard::setType('summary_large_image');

        // Set JSON-LD
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl($url);
        JsonLd::setType('WebPage');
        JsonLd::addImage($image);

        return $this;
    }

    /**
     * Set homepage SEO
     */
    public function setHomepageSEO()
    {
        return $this->setPageSEO([
            'title' => 'Centrova | AI Venture Engineering, Software Development & AI Agent Automation',
            'description' => 'PT Centrova Teknologi Indonesia adalah AI Venture Engineering company yang membantu bisnis membangun software, AI-powered systems, dan AI Agent Automation untuk meningkatkan efisiensi, mempercepat pertumbuhan, dan mendorong transformasi digital.',
            'keywords' => ['Centrova', 'PT Centrova Teknologi Indonesia', 'AI Venture Engineering', 'Software Development', 'AI Agent Automation', 'Artificial Intelligence Indonesia', 'AI Solutions', 'Business Automation', 'centrova.id', 'centrova indonesia', 'web development', 'custom software', 'digital transformation Indonesia'],
            'type' => 'website'
        ]);
    }

    /**
     * Set service page SEO
     */
    public function setServiceSEO(string $serviceName, string $serviceDescription)
    {
        return $this->setPageSEO([
            'title' => $serviceName . ' | Centrova',
            'description' => $serviceDescription,
            'keywords' => $this->generateServiceKeywords($serviceName),
            'type' => 'service'
        ]);
    }

    /**
     * Set blog/article SEO — enhanced for NewsArticle + GEO compatibility
     */
    public function setArticleSEO(array $article)
    {
        $title = $article['title'] . ' | Blog Centrova';
        $description = $article['excerpt'] ?? substr(strip_tags($article['content']), 0, 160);
        $image = $article['featured_image'] ?? $this->defaultImage;
        $keywords = $this->generateArticleKeywords($article);
        $url = $article['url'] ?? URL::current();

        $this->setPageSEO([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'image' => $image,
            'url' => $url,
            'type' => 'article'
        ]);

        // Add article-specific JSON-LD (NewsArticle type for Google News eligibility)
        JsonLd::setType('NewsArticle');
        JsonLd::addValue('author', [
            '@type' => 'Organization',
            'name' => $article['author'] ?? 'Centrova Team',
            'url' => config('app.url')
        ]);
        JsonLd::addValue('publisher', [
            '@type' => 'Organization',
            'name' => 'Centrova',
            'url' => config('app.url'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('assets/images/centrova-logo.png'),
                'width' => 600,
                'height' => 60
            ]
        ]);
        JsonLd::addValue('datePublished', $article['published_at'] ?? now()->toISOString());
        JsonLd::addValue('dateModified', $article['updated_at'] ?? now()->toISOString());
        JsonLd::addValue('inLanguage', 'id');
        JsonLd::addValue('isAccessibleForFree', 'True');

        if (isset($article['category'])) {
            JsonLd::addValue('articleSection', $article['category']);
        }

        if (isset($article['tags']) && is_array($article['tags'])) {
            JsonLd::addValue('keywords', implode(', ', $article['tags']));
        }

        // Add speakable sections for voice assistants and AI engines (GEO)
        JsonLd::addValue('speakable', [
            '@type' => 'SpeakableSpecification',
            'cssSelector' => ['.article-content h2', '.article-content p']
        ]);

        return $this;
    }

    /**
     * Add organization schema
     */
    public function addOrganizationSchema()
    {
        $organization = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Centrova',
            'url' => config('app.url'),
            'logo' => asset('assets/images/centrova-logo.png'),
            'description' => $this->defaultDescription,
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'ID',
                'addressLocality' => 'Indonesia'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+62-XXX-XXXX-XXXX',
                'contactType' => 'Customer Service',
                'availableLanguage' => ['Indonesian', 'English']
            ],
            'sameAs' => [
                'https://facebook.com/centrova',
                'https://twitter.com/centrova_id',
                'https://instagram.com/centrova_id',
                'https://linkedin.com/company/centrova'
            ]
        ];

        return json_encode($organization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Add website schema
     */
    public function addWebsiteSchema()
    {
        $website = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Centrova',
            'url' => config('app.url'),
            'description' => $this->defaultDescription,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => config('app.url') . '/search?q={search_term_string}',
                'query-input' => 'required name=search_term_string'
            ]
        ];

        return json_encode($website, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Add breadcrumb schema
     */
    public function addBreadcrumbSchema(array $breadcrumbs)
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
     * Add FAQ schema
     */
    public function addFAQSchema(array $faqs)
    {
        $mainEntity = [];
        
        foreach ($faqs as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }

        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity
        ];

        return json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Add service schema
     */
    public function addServiceSchema(array $service)
    {
        $serviceSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service['name'],
            'description' => $service['description'],
            'provider' => [
                '@type' => 'Organization',
                'name' => 'Centrova',
                'url' => config('app.url')
            ],
            'areaServed' => 'Indonesia',
            'availableChannel' => [
                '@type' => 'ServiceChannel',
                'serviceUrl' => $service['url'] ?? config('app.url'),
                'serviceType' => $service['type'] ?? 'Web Development'
            ]
        ];

        if (isset($service['price'])) {
            $serviceSchema['offers'] = [
                '@type' => 'Offer',
                'price' => $service['price'],
                'priceCurrency' => 'IDR'
            ];
        }

        return json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Generate keywords from service name
     */
    protected function generateServiceKeywords(string $serviceName): array
    {
        $baseKeywords = $this->defaultKeywords;
        $serviceKeywords = [
            strtolower($serviceName),
            strtolower($serviceName) . ' indonesia',
            'jasa ' . strtolower($serviceName),
            'layanan ' . strtolower($serviceName)
        ];

        return array_merge($baseKeywords, $serviceKeywords);
    }

    /**
     * Generate keywords from article data
     */
    protected function generateArticleKeywords(array $article): array
    {
        $keywords = $this->defaultKeywords;
        
        // Add tags if available
        if (isset($article['tags']) && is_array($article['tags'])) {
            $keywords = array_merge($keywords, $article['tags']);
        }

        // Add category if available
        if (isset($article['category'])) {
            $keywords[] = $article['category'];
        }

        return array_unique($keywords);
    }

    /**
     * Get current route-based SEO data
     */
    public function getRouteBasedSEO()
    {
        $routeName = Route::currentRouteName() ?? 'home';
        $routeData = $this->getRouteData($routeName);

        return $this->setPageSEO($routeData);
    }

    /**
     * Get SEO data based on route name
     */
    protected function getRouteData(string $routeName): array
    {
        $routeMap = [
            'home' => [
                'title' => 'Centrova - Platform Digital Terdepan Indonesia',
                'description' => 'Solusi lengkap web development, hosting berkualitas tinggi, dan layanan teknologi modern untuk bisnis Anda.',
                'keywords' => ['web development indonesia', 'hosting murah', 'domain murah', 'jasa website']
            ],
            'about' => [
                'title' => 'Tentang Kami | Centrova',
                'description' => 'Mengenal lebih dekat Centrova, tim profesional dengan pengalaman puluhan tahun di bidang teknologi digital.',
                'keywords' => ['tentang centrova', 'profil perusahaan', 'team centrova']
            ],
            'services' => [
                'title' => 'Layanan Kami | Centrova',
                'description' => 'Berbagai layanan teknologi terbaik dari Centrova: Web Development, Hosting, Domain, dan solusi digital lainnya.',
                'keywords' => ['layanan centrova', 'jasa web development', 'hosting indonesia']
            ],
            'contact' => [
                'title' => 'Hubungi Kami | Centrova',
                'description' => 'Hubungi tim Centrova untuk konsultasi gratis tentang kebutuhan teknologi digital bisnis Anda.',
                'keywords' => ['kontak centrova', 'konsultasi gratis', 'hubungi centrova']
            ],
            'blog' => [
                'title' => 'Blog & Artikel | Centrova',
                'description' => 'Baca artikel terbaru tentang web development, teknologi, dan tips digital marketing dari para ahli Centrova.',
                'keywords' => ['blog centrova', 'artikel teknologi', 'tips web development']
            ]
        ];

        return $routeMap[$routeName] ?? [];
    }
}