# SEO Testing Checklist

## ✅ Packages Installed
- [x] artesaos/seotools
- [x] spatie/laravel-sitemap 
- [x] spatie/laravel-tags

## ✅ Configuration Files
- [x] config/seotools.php - Configured for Centrova
- [x] config/services.php - Added Google Analytics, social media configs
- [x] .env.example - SEO environment variables

## ✅ Core SEO Files
- [x] app/Services/SEOService.php - Main SEO service
- [x] app/Http/Middleware/SEOMiddleware.php - Auto SEO middleware
- [x] app/Providers/SEOServiceProvider.php - Service provider
- [x] app/Helpers/SEOHelper.php - Utility functions

## ✅ Views & Components
- [x] resources/views/partials/layouts/main.blade.php - Updated with SEO integration
- [x] app/View/Components/LazyImage.php - Lazy loading component
- [x] resources/views/components/lazy-image.blade.php - Component template

## ✅ Controllers & Routes
- [x] app/Http/Controllers/SitemapController.php - XML sitemap generation
- [x] routes/main.php - Added /sitemap.xml route

## ✅ SEO Files
- [x] public/robots.txt - Optimized for search engines
- [x] public/manifest.json - PWA manifest

## ✅ Middleware Registration
- [x] app/Http/Kernel.php - SEOMiddleware added to web group
- [x] config/app.php - SEOServiceProvider registered

## 🧪 Testing URLs

### Basic URLs to Test:
1. Homepage: `http://localhost:8000/` - Should have complete SEO meta tags
2. Sitemap: `http://localhost:8000/sitemap.xml` - Should generate XML sitemap
3. Robots: `http://localhost:8000/robots.txt` - Should show optimized robots.txt

### SEO Meta Tags to Verify:
```html
<!-- Title -->
<title>Page Title | Centrova</title>

<!-- Meta tags -->
<meta name="description" content="...">
<meta name="keywords" content="...">
<meta name="robots" content="index,follow">
<meta name="canonical" href="...">

<!-- Open Graph -->
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="...">
<meta property="og:url" content="...">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="...">
<meta name="twitter:description" content="...">

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Centrova",
  ...
}
</script>
```

## 🔧 Manual Testing Commands

```bash
# Test if SEO middleware is working
curl -I http://localhost:8000/

# Test sitemap generation
curl http://localhost:8000/sitemap.xml

# Test robots.txt
curl http://localhost:8000/robots.txt

# Check for meta tags
curl http://localhost:8000/ | grep -i "meta\|title\|og:"

# Test Google crawler simulation
curl -H "User-Agent: Googlebot/2.1" http://localhost:8000/
```

## 🛠️ SEO Tools for Testing

### Online Testing Tools:
1. **Google Rich Results Test**: https://search.google.com/test/rich-results
2. **Facebook Sharing Debugger**: https://developers.facebook.com/tools/debug/
3. **Twitter Card Validator**: https://cards-dev.twitter.com/validator
4. **Google PageSpeed Insights**: https://pagespeed.web.dev/
5. **SEOlyzer**: https://seolyzer.com/
6. **Screaming Frog SEO Spider**: https://www.screamingfrog.co.uk/seo-spider/

### Browser Extensions:
1. **SEO Meta in 1 Click** - Chrome extension
2. **MozBar** - SEO toolbar
3. **SEOquake** - SEO audit tool

## 📊 Performance Metrics to Monitor

### Core Web Vitals:
- **LCP (Largest Contentful Paint)**: < 2.5s
- **FID (First Input Delay)**: < 100ms  
- **CLS (Cumulative Layout Shift)**: < 0.1

### SEO Metrics:
- **Page Load Speed**: < 3s
- **Mobile Responsiveness**: 100% mobile-friendly
- **HTTPS**: All pages secure
- **Meta Tags**: 100% coverage
- **Structured Data**: No errors
- **Sitemap**: All pages indexed

## 🚨 Common Issues & Solutions

### Issue 1: Meta tags tidak muncul
**Solution**: 
```bash
php artisan config:clear
php artisan cache:clear
```

### Issue 2: Sitemap error 404
**Solution**: 
- Check route registration: `php artisan route:list | grep sitemap`
- Verify controller method exists

### Issue 3: Middleware tidak jalan
**Solution**: 
- Check middleware registration in Kernel.php
- Verify middleware class exists

### Issue 4: Structured data error
**Solution**: 
- Validate JSON-LD syntax
- Test with Google Rich Results Test

### Issue 5: Images tidak lazy load
**Solution**: 
- Check JavaScript console for errors
- Verify IntersectionObserver support

## ✅ Production Checklist

Before going live, ensure:
- [ ] All meta tags are unique per page
- [ ] Sitemap.xml is accessible and valid
- [ ] Robots.txt allows search engine crawling
- [ ] Google Analytics is configured
- [ ] Search Console verification is complete
- [ ] Social media preview images are optimized
- [ ] Page loading speed is optimized
- [ ] Mobile responsiveness is perfect
- [ ] All structured data validates
- [ ] Canonical URLs are correct

## 📈 Post-Launch Monitoring

### Weekly:
- [ ] Check Google Search Console for errors
- [ ] Monitor page loading speeds
- [ ] Review search rankings

### Monthly:
- [ ] Update meta descriptions for new content
- [ ] Review and optimize keywords
- [ ] Check structured data validity
- [ ] Monitor social media sharing metrics

### Quarterly:
- [ ] Full SEO audit
- [ ] Update schema.org implementations
- [ ] Review and update robots.txt
- [ ] Performance optimization review