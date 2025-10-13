# SEO Implementation Documentation

## Overview
Implementasi SEO lengkap untuk website Laravel Centrova yang mencakup:
- Meta tags dinamis untuk semua halaman
- Open Graph dan Twitter Card support
- JSON-LD Structured Data (Schema.org)
- Sitemap XML otomatis
- Robots.txt yang optimal
- Performance optimization
- Social media integration

## Features Implemented

### 1. SEO Tools Package Integration
- **artesaos/seotools**: Meta tags, Open Graph, Twitter Card, JSON-LD
- **spatie/laravel-sitemap**: Automatic XML sitemap generation
- **spatie/laravel-tags**: Keyword and tag management

### 2. SEO Service (`App\Services\SEOService`)
Class utama untuk mengelola semua aspek SEO:
- `setPageSEO()`: Set SEO data untuk halaman
- `setHomepageSEO()`: SEO khusus homepage
- `setServiceSEO()`: SEO untuk halaman layanan
- `setArticleSEO()`: SEO untuk artikel/blog
- Schema.org generators (Organization, Website, Breadcrumb, FAQ, Service)

### 3. SEO Middleware (`App\Http\Middleware\SEOMiddleware`)
Middleware yang otomatis menerapkan SEO berdasarkan route:
- Deteksi route otomatis
- Set meta tags default
- Inject structured data global

### 4. Layout Integration (`resources/views/partials/layouts/main.blade.php`)
Layout utama telah diintegrasikan dengan:
- SEOTools tags: `{!! SEO::generate() !!}`
- Global structured data scripts
- Google Analytics/GA4 integration
- Performance optimization (DNS prefetch, preload)
- Web Manifest untuk PWA support

### 5. Lazy Loading Component (`App\View\Components\LazyImage`)
Component untuk optimasi gambar:
- Intersection Observer API
- Progressive image loading
- Fallback untuk browser lama
- Performance boost untuk loading time

## Usage Examples

### Basic Page SEO
```php
// In your controller
public function show()
{
    $seoService = app(SEOService::class);
    $seoService->setPageSEO([
        'title' => 'Page Title | Centrova',
        'description' => 'Page description here',
        'keywords' => ['keyword1', 'keyword2'],
        'image' => asset('images/page-image.jpg')
    ]);
    
    return view('page');
}
```

### Homepage SEO
```php
// In HomeController
public function index()
{
    $seoService = app(SEOService::class);
    $seoService->setHomepageSEO();
    
    return view('home');
}
```

### Article/Blog SEO
```php
// In ArticleController
public function show($article)
{
    $seoService = app(SEOService::class);
    $seoService->setArticleSEO([
        'title' => $article->title,
        'excerpt' => $article->excerpt,
        'content' => $article->content,
        'featured_image' => $article->featured_image,
        'author' => $article->author,
        'published_at' => $article->published_at,
        'updated_at' => $article->updated_at,
        'tags' => $article->tags->pluck('name')->toArray()
    ]);
    
    return view('article.show', compact('article'));
}
```

### Adding Structured Data in Views
```blade
@push('structured-data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "Web Development",
    "description": "Professional web development services",
    "provider": {
        "@type": "Organization",
        "name": "Centrova"
    }
}
</script>
@endpush
```

### Using Lazy Loading Component
```blade
<x-lazy-image 
    src="/assets/images/hero.jpg" 
    alt="Hero Image" 
    class="w-full h-64 object-cover"
    width="800"
    height="400"
/>
```

## Configuration

### Environment Variables
Add these to your `.env` file:
```env
# SEO Configuration
GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX
GOOGLE_SITE_VERIFICATION=your_verification_code
GOOGLE_TAG_MANAGER_ID=GTM-XXXXXXX
BING_SITE_VERIFICATION=your_bing_verification
YANDEX_SITE_VERIFICATION=your_yandex_verification

# Social Media
FACEBOOK_APP_ID=your_facebook_app_id
FACEBOOK_PIXEL_ID=your_pixel_id
TWITTER_SITE=@centrova_id
TWITTER_CREATOR=@centrova_id

# Performance
IMAGE_OPTIMIZATION_ENABLED=true
```

### SEOTools Configuration (`config/seotools.php`)
File konfigurasi telah dioptimalkan dengan:
- Default title, description, keywords untuk Centrova
- Open Graph dan Twitter Card settings
- JSON-LD default configuration
- Webmaster tools verification tags

## Files Created/Modified

### New Files:
1. `app/Services/SEOService.php` - Main SEO service class
2. `app/Http/Middleware/SEOMiddleware.php` - Auto SEO middleware
3. `app/Providers/SEOServiceProvider.php` - SEO service provider
4. `app/View/Components/LazyImage.php` - Lazy loading component
5. `app/Helpers/SEOHelper.php` - SEO utility functions
6. `resources/views/components/lazy-image.blade.php` - Lazy image template
7. `resources/views/example-seo-usage.blade.php` - Usage examples
8. `public/manifest.json` - PWA manifest
9. `.env.example` - Environment configuration template

### Modified Files:
1. `resources/views/partials/layouts/main.blade.php` - Added SEO integration
2. `config/seotools.php` - Centrova-specific configuration
3. `config/services.php` - Added Google Analytics, social media config
4. `config/app.php` - Registered SEOServiceProvider
5. `app/Http/Kernel.php` - Added SEOMiddleware to web group
6. `routes/main.php` - Added sitemap.xml route
7. `app/Http/Controllers/SitemapController.php` - Enhanced for XML sitemap
8. `public/robots.txt` - Optimized for search engines

## Performance Optimizations

### 1. Caching
- Redis caching untuk meta data
- Cache sitemap generation
- SEO data caching dalam SEOHelper

### 2. Image Optimization
- Lazy loading dengan Intersection Observer
- WebP format support (jika tersedia)
- Progressive loading dengan placeholder

### 3. JavaScript & CSS
- DNS prefetch untuk external resources
- Preload critical fonts
- Async loading untuk non-critical scripts

### 4. Database
- Efficient queries untuk sitemap generation
- Index optimization untuk SEO-related fields

## Search Engine Features

### 1. XML Sitemap (`/sitemap.xml`)
- Automatic generation dari routes
- Priority dan changefreq settings
- Support untuk dynamic content (blog, services, portfolio)

### 2. Robots.txt (`/robots.txt`)
- Allow semua search engines
- Disallow admin dan private areas
- Sitemap declaration
- Crawl delay optimization

### 3. Structured Data (JSON-LD)
- Organization schema global
- Website schema dengan search action
- Breadcrumb navigation
- Article schema untuk blog posts
- Service schema untuk halaman layanan
- FAQ schema untuk halaman FAQ

### 4. Meta Tags
- Title tags yang SEO-friendly
- Meta descriptions unik per halaman
- Keywords berdasarkan content
- Canonical URLs untuk mencegah duplicate content
- Robots directives (index/noindex, follow/nofollow)

### 5. Social Media Optimization
- Open Graph tags untuk Facebook, LinkedIn, WhatsApp
- Twitter Card untuk Twitter/X
- Image optimization untuk social sharing
- Automatic meta generation berdasarkan content

## Monitoring & Analytics

### 1. Google Analytics/GA4
- Automatic tracking script injection
- Event tracking ready
- E-commerce tracking support

### 2. Search Console
- Meta verification tags
- Sitemap auto-submission
- Error monitoring ready

### 3. Performance Monitoring
- Core Web Vitals optimization
- Loading speed optimization
- Mobile-first responsive design

## Best Practices Implemented

1. **Mobile-First Design**: Responsive meta viewport
2. **Performance**: Lazy loading, caching, minification
3. **Accessibility**: Alt tags, semantic HTML structure
4. **Security**: CSRF protection, secure headers
5. **Standards Compliance**: Schema.org, Open Graph, Twitter Card
6. **User Experience**: Fast loading, progressive enhancement
7. **SEO Guidelines**: Google, Bing, Yandex best practices

## Maintenance

### Regular Tasks:
1. Monitor sitemap generation
2. Update structured data schemas
3. Check Google Search Console for errors
4. Update meta descriptions untuk new content
5. Monitor page loading speeds
6. Review and update keywords

### Yearly Tasks:
1. Review dan update schema.org implementations
2. Audit meta tags untuk all pages
3. Update social media preview images
4. Review robots.txt rules
5. Performance audit dan optimization

## Testing

### SEO Testing Tools:
1. Google Rich Results Test
2. Facebook Sharing Debugger
3. Twitter Card Validator
4. Google PageSpeed Insights
5. GTmetrix
6. SEMrush Site Audit

### Local Testing:
```bash
# Test sitemap generation
curl http://localhost:8000/sitemap.xml

# Test robots.txt
curl http://localhost:8000/robots.txt

# Test structured data
curl -H "User-Agent: Googlebot" http://localhost:8000/
```

## Troubleshooting

### Common Issues:
1. **Sitemap tidak generate**: Check route registration dan permissions
2. **Meta tags tidak muncul**: Verify middleware registration
3. **Structured data error**: Validate JSON-LD syntax
4. **Images tidak lazy load**: Check JavaScript console untuk errors
5. **Cache issues**: Clear cache dengan `php artisan cache:clear`

Implementasi ini memberikan foundation SEO yang kuat untuk website Centrova dan dapat di-extend sesuai kebutuhan spesifik di masa depan.