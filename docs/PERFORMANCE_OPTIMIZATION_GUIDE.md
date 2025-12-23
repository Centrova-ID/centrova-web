# 🚀 CENTROVA WEB - HIGH-PERFORMANCE OPTIMIZATION GUIDE

## Target: Page Refresh < 100ms (NASA-Grade Performance)

### 📋 DAFTAR IMPLEMENTASI

Semua file optimasi telah dibuat dan siap digunakan. Berikut struktur lengkapnya:

```
✅ Config Files
├── config/performance.php           # Konfigurasi performa lengkap
├── .env.performance.example         # Environment variables untuk produksi

✅ Services & Utilities
├── app/Services/CacheService.php    # Advanced caching service
├── app/Traits/CachesQueries.php     # Database query caching trait

✅ Middleware
├── app/Http/Middleware/PerformanceCacheMiddleware.php  # Response caching
├── app/Http/Middleware/OptimizedMiddleware.php         # Performance headers

✅ View Components
├── app/View/Components/CachedComponent.php              # Cached component base
├── app/Providers/BladeServiceProvider.php               # Blade directives

✅ Controllers
├── app/Http/Controllers/OptimizedHomeController.php     # Example optimized controller

✅ Views
├── resources/views/layouts/optimized.blade.php          # Optimized layout
├── resources/views/home/partials/stats.blade.php        # Turbo Frame example
├── resources/views/home/partials/stats-stream.blade.php # Turbo Stream example

✅ Console Commands
├── app/Console/Commands/OptimizePerformance.php         # Optimize command
├── app/Console/Commands/PerformanceBenchmark.php        # Benchmark tool
├── app/Console/Commands/CacheWarm.php                   # Cache warming

✅ Frontend
├── vite.config.js                   # Optimized Vite config
├── resources/js/bootstrap.js        # Turbo integration
```

---

## 🔧 LANGKAH IMPLEMENTASI

### 1️⃣ **INSTALL DEPENDENCIES**

```bash
# Install Redis PHP extension (jika belum)
# Windows: Uncomment extension=redis di php.ini
# Linux: sudo apt install php-redis

# Install Composer dependencies
composer install --optimize-autoloader --no-dev

# Install NPM dependencies
npm install

# Build assets untuk production
npm run build
```

### 2️⃣ **REGISTER SERVICE PROVIDERS**

Edit `config/app.php`:

```php
'providers' => [
    // ... existing providers
    App\Providers\BladeServiceProvider::class,
],
```

### 3️⃣ **REGISTER MIDDLEWARE**

Edit `app/Http/Kernel.php`:

```php
protected $middlewareGroups = [
    'web' => [
        // ... existing middleware
        \App\Http\Middleware\OptimizedMiddleware::class,
    ],
];

protected $middlewareAliases = [
    // ... existing aliases
    'performance.cache' => \App\Http\Middleware\PerformanceCacheMiddleware::class,
];
```

### 4️⃣ **CONFIGURE ENVIRONMENT**

Copy dan edit `.env`:

```bash
cp .env.performance.example .env.production
```

Edit `.env`:

```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

# Performance settings
CACHE_STATIC_TTL=3600
CACHE_DYNAMIC_TTL=300
CACHE_PRE_WARM=true
HTTP2_PUSH_ENABLED=true
```

### 5️⃣ **SETUP REDIS**

**Windows:**
```bash
# Download Redis for Windows
# https://github.com/microsoftarchive/redis/releases
# Jalankan redis-server.exe
```

**Linux:**
```bash
sudo apt update
sudo apt install redis-server
sudo systemctl start redis
sudo systemctl enable redis
```

**Verify Redis:**
```bash
redis-cli ping
# Response: PONG
```

### 6️⃣ **OPTIMIZE APPLICATION**

```bash
# Run optimization command
php artisan performance:optimize

# Manual steps (included in command above):
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
composer dump-autoload -o
```

### 7️⃣ **PRE-WARM CACHE**

```bash
php artisan cache:warm
```

### 8️⃣ **UPDATE ROUTES**

Edit `routes/web.php` - tambahkan routes untuk Turbo:

```php
use App\Http\Controllers\OptimizedHomeController;

Route::get('/', [OptimizedHomeController::class, 'index'])->name('home');
Route::get('/products', [OptimizedHomeController::class, 'products'])->name('products');
Route::get('/stats', [OptimizedHomeController::class, 'updateStats'])->name('home.stats');
```

### 9️⃣ **UPDATE MODELS**

Tambahkan trait `CachesQueries` ke model yang sering di-query:

```php
use App\Traits\CachesQueries;

class User extends Authenticatable
{
    use CachesQueries;
    
    // ... existing code
}
```

**Cara pakai:**

```php
// Cache query results
$users = User::where('active', 1)->cached(600)->get();

// Cache with relationships
$users = User::cachedWith(['posts', 'comments'], 600);

// Cache single model
$user = User::cacheFind($id, 3600);

// Clear model cache
User::first()->clearModelCache();
```

---

## 📊 BENCHMARKING & MONITORING

### Run Performance Benchmark

```bash
# Benchmark homepage
php artisan performance:benchmark --url=/ --runs=10

# Benchmark specific page
php artisan performance:benchmark --url=/products --runs=20

# Results will show:
# - Average response time
# - Min/Max/Median/P95
# - Performance grade
# - Recommendations
```

### Install Laravel Telescope (Development Only)

```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

Access: `http://your-app.test/telescope`

### Install Laravel Debugbar (Development Only)

```bash
composer require barryvdh/laravel-debugbar --dev
```

---

## 🎯 TURBO-FIRST ARCHITECTURE

### Menggunakan Turbo Frames

**View:**
```blade
{{-- Layout utama --}}
@extends('layouts.optimized')

@section('content')
<div class="container">
    {{-- Turbo Frame untuk stats - lazy loaded --}}
    <turbo-frame id="stats" src="{{ route('home.stats') }}" loading="lazy">
        <p>Loading stats...</p>
    </turbo-frame>
    
    {{-- Turbo Frame untuk products --}}
    @turboFrame('products')
        @include('home.partials.products')
    @endTurboFrame
</div>
@endsection
```

**Controller:**
```php
public function stats(Request $request)
{
    // Check if Turbo Frame request
    if ($request->header('Turbo-Frame')) {
        return view('home.partials.stats', [
            'stats' => $this->getStats()
        ]);
    }
    
    // Full page request
    return view('home.index');
}
```

### Menggunakan Turbo Streams

**Update real-time tanpa reload:**

```php
// Controller
public function updateStats()
{
    $stats = $this->getStats();
    
    return response()
        ->view('home.partials.stats-stream', ['stats' => $stats])
        ->header('Content-Type', 'text/vnd.turbo-stream.html');
}
```

**View (stats-stream.blade.php):**
```blade
@turboStream('replace', 'stats')
    <div id="stats">
        {{-- Updated content --}}
    </div>
@endTurboStream
```

**JavaScript (trigger update):**
```javascript
// Auto-update stats every 30 seconds
setInterval(() => {
    fetch('/stats', {
        headers: {
            'Accept': 'text/vnd.turbo-stream.html'
        }
    }).then(response => response.text())
      .then(html => Turbo.renderStreamMessage(html));
}, 30000);
```

---

## 💾 FRAGMENT CACHING

### Blade Directive Usage

```blade
{{-- Cache fragment for 15 minutes --}}
@cacheFragment('sidebar.navigation', 900, ['fragments', 'navigation'])
<nav class="sidebar">
    @foreach($menuItems as $item)
        <a href="{{ $item->url }}">{{ $item->title }}</a>
    @endforeach
</nav>
@endCacheFragment

{{-- Cache with dynamic key --}}
@cacheFragment('user-dashboard-' . auth()->id(), 300)
    {{-- Expensive user-specific content --}}
@endCacheFragment
```

### Clear Fragment Cache

```php
// Clear specific tags
Cache::tags(['fragments', 'navigation'])->flush();

// Clear all fragments
Cache::tags(['fragments'])->flush();
```

---

## 🗄️ DATABASE OPTIMIZATION

### Add Indexes for Performance

**Create migration:**
```bash
php artisan make:migration add_performance_indexes
```

**Migration file:**
```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->index('email');
        $table->index('created_at');
        $table->index(['active', 'created_at']); // Composite index
    });
    
    Schema::table('posts', function (Blueprint $table) {
        $table->index('user_id');
        $table->index('published_at');
        $table->index(['user_id', 'published_at']);
    });
}
```

### Eager Loading (Prevent N+1)

**Bad (N+1 Problem):**
```php
$users = User::all();
foreach ($users as $user) {
    echo $user->posts->count(); // N queries
}
```

**Good (Eager Loading):**
```php
$users = User::with('posts')->all();
foreach ($users as $user) {
    echo $user->posts->count(); // 1 query
}
```

**With Caching:**
```php
$users = User::cachedWith(['posts', 'comments'], 600);
```

---

## ⚡ SERVER-SIDE OPTIMIZATION

### 1. OPcache Configuration

Edit `php.ini`:

```ini
[opcache]
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.revalidate_freq=0
opcache.validate_timestamps=0  ; Production only!
opcache.fast_shutdown=1
opcache.enable_cli=0
```

**Restart PHP:**
```bash
# Windows: Restart PHP service
# Linux: sudo systemctl restart php8.1-fpm
```

### 2. Laravel Octane (Optional - 2-4x Performance Boost)

```bash
# Install Octane with Swoole
composer require laravel/octane
php artisan octane:install --server=swoole

# Or RoadRunner
php artisan octane:install --server=roadrunner

# Run Octane
php artisan octane:start --workers=4 --max-requests=500
```

**Nginx config for Octane:**
```nginx
server {
    listen 80;
    server_name your-domain.com;
    
    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

### 3. PHP-FPM Tuning

Edit `/etc/php/8.1/fpm/pool.d/www.conf`:

```ini
pm = dynamic
pm.max_children = 50
pm.start_servers = 10
pm.min_spare_servers = 5
pm.max_spare_servers = 20
pm.max_requests = 500
```

---

## 🌐 WEB SERVER OPTIMIZATION

### Nginx Configuration

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name your-domain.com;
    root /var/www/centrova-web/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    # Gzip Compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css text/xml text/javascript 
               application/x-javascript application/xml+rss 
               application/javascript application/json;

    # Browser Caching
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # PHP-FPM
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_buffer_size 32k;
        fastcgi_buffers 4 32k;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Enable HTTP/2

```nginx
server {
    listen 443 ssl http2;
    # ... rest of config
}
```

---

## 📈 PERFORMANCE MONITORING

### Daily Monitoring Commands

```bash
# Check cache hit rate
php artisan tinker
>>> app(\App\Services\CacheService::class)->getStats()

# Benchmark application
php artisan performance:benchmark --runs=20

# Check query performance
php artisan telescope:prune  # Keep DB clean
```

### Production Checklist

- [ ] Redis running and configured
- [ ] OPcache enabled
- [ ] Config/Route/View cached
- [ ] Assets minified and built
- [ ] Database indexes added
- [ ] Gzip/Brotli compression enabled
- [ ] HTTP/2 enabled
- [ ] CDN configured (optional)
- [ ] Cache pre-warmed
- [ ] Benchmark showing <100ms

---

## 🎉 HASIL YANG DIHARAPKAN

### Before Optimization
- **Page Load:** ~800-1500ms
- **Database Queries:** 20-50 per page
- **Cache Hit Rate:** 0%
- **TTFB:** 200-400ms

### After Optimization
- **Page Load:** **50-100ms** ✅
- **Database Queries:** 1-5 per page (cached)
- **Cache Hit Rate:** 90-95%
- **TTFB:** 10-30ms

### Performance Comparison

| Metric | Before | After | Improvement |
|--------|--------|-------|-------------|
| First Paint | 800ms | 80ms | **90%** |
| Time to Interactive | 1200ms | 120ms | **90%** |
| Total Page Size | 2.5MB | 800KB | **68%** |
| HTTP Requests | 45 | 12 | **73%** |

---

## 🔍 TROUBLESHOOTING

### Redis Connection Failed

```bash
# Check Redis status
redis-cli ping

# If not running
sudo systemctl start redis

# Check connection
php artisan tinker
>>> Illuminate\Support\Facades\Redis::connection()->ping()
```

### Cache Not Working

```bash
# Clear all cache
php artisan cache:clear
php artisan config:clear

# Check cache driver
php artisan tinker
>>> config('cache.default')
```

### Slow Queries

```bash
# Enable query logging
DB::enableQueryLog();

# Run your code

# See queries
dd(DB::getQueryLog());
```

### Build Errors

```bash
# Clear node modules
rm -rf node_modules
rm package-lock.json
npm install
npm run build
```

---

## 🚀 NEXT STEPS

1. **Implement Octane** untuk 2-4x performance boost
2. **Setup CDN** untuk static assets
3. **Add Full-text Search** dengan Meilisearch/Algolia
4. **Implement GraphQL** untuk API optimization
5. **Add Service Worker** untuk offline support

---

## 📚 RESOURCES

- [Laravel Performance Best Practices](https://laravel.com/docs/10.x/deployment#optimization)
- [Hotwire Turbo Documentation](https://turbo.hotwired.dev/)
- [Redis Caching Strategies](https://redis.io/docs/manual/patterns/)
- [Laravel Octane](https://laravel.com/docs/10.x/octane)

---

**Built with ❤️ for Centrova - Achieving NASA-grade performance!**
