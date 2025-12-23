# 🚀 QUICK START - PERFORMANCE OPTIMIZATION

## ⚡ 5-Minute Setup untuk Hasil Instan

### STEP 1: Install Redis (jika belum)

**Windows:**
```bash
# Download: https://github.com/microsoftarchive/redis/releases
# Extract dan jalankan redis-server.exe
redis-server.exe
```

**Linux:**
```bash
sudo apt update && sudo apt install redis-server -y
sudo systemctl start redis
```

**Verify:**
```bash
redis-cli ping
# Output: PONG
```

---

### STEP 2: Update .env

```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

CACHE_STATIC_TTL=3600
CACHE_DYNAMIC_TTL=300
CACHE_PRE_WARM=true
```

---

### STEP 3: Register Service Provider

Edit `config/app.php`:

```php
'providers' => [
    // ... existing
    App\Providers\BladeServiceProvider::class,
],
```

---

### STEP 4: Register Middleware

Edit `app/Http/Kernel.php`:

```php
protected $middlewareGroups = [
    'web' => [
        // ... existing middleware
        \App\Http\Middleware\OptimizedMiddleware::class,
    ],
];

protected $middlewareAliases = [
    // ... existing
    'performance.cache' => \App\Http\Middleware\PerformanceCacheMiddleware::class,
];
```

---

### STEP 5: Optimize Application

```bash
# Install dependencies
composer install --optimize-autoloader

# Build assets
npm install
npm run build

# Run optimization
php artisan performance:optimize
```

---

### STEP 6: Test Performance

```bash
# Benchmark aplikasi
php artisan performance:benchmark --url=/ --runs=10

# Expected result:
# Average: < 100ms ✅
# Grade: EXCELLENT 🌟
```

---

## 🎯 USAGE EXAMPLES

### 1. Cache Query Results

```php
use App\Traits\CachesQueries;

class User extends Model
{
    use CachesQueries;
}

// In controller
$users = User::where('active', 1)->cached(600)->get();
```

### 2. Cache Blade Fragments

```blade
@cacheFragment('sidebar-nav', 900)
    <nav>
        {{-- Expensive menu generation --}}
    </nav>
@endCacheFragment
```

### 3. Use Turbo Frames

```blade
<turbo-frame id="stats" src="{{ route('stats') }}" loading="lazy">
    Loading...
</turbo-frame>
```

### 4. Optimized Controller

```php
class HomeController extends Controller
{
    public function __construct(CacheService $cache)
    {
        $this->cache = $cache;
        $this->middleware('performance.cache:300');
    }
    
    public function index()
    {
        $data = $this->cache->remember('home.data', 600, function () {
            return ['users' => User::count()];
        });
        
        return view('home', $data);
    }
}
```

---

## 📊 VERIFY PERFORMANCE

### Check Cache Working

```bash
php artisan tinker
>>> Cache::put('test', 'working', 60)
>>> Cache::get('test')
# Output: "working"
```

### Monitor Cache Stats

```bash
php artisan tinker
>>> app(\App\Services\CacheService::class)->getStats()
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🔥 PRODUCTION DEPLOYMENT

```bash
# 1. Optimize everything
php artisan performance:optimize

# 2. Warm cache
php artisan cache:warm

# 3. Set permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 4. Verify
php artisan performance:benchmark --runs=20
```

---

## ✅ CHECKLIST

- [ ] Redis installed and running
- [ ] .env configured for Redis
- [ ] Service providers registered
- [ ] Middleware registered
- [ ] Assets built (`npm run build`)
- [ ] Application optimized (`php artisan performance:optimize`)
- [ ] Cache warmed (`php artisan cache:warm`)
- [ ] Benchmark showing <100ms

---

## 🆘 TROUBLESHOOTING

**Redis not connecting:**
```bash
# Check if Redis is running
redis-cli ping

# Restart Redis (Linux)
sudo systemctl restart redis

# Check Laravel config
php artisan config:clear
```

**Cache not working:**
```bash
# Verify cache driver
php artisan tinker
>>> config('cache.default')
# Should output: "redis"
```

**Slow performance:**
```bash
# Check for slow queries
php artisan telescope:list

# Run benchmark
php artisan performance:benchmark
```

---

## 📈 EXPECTED RESULTS

| Metric | Target | Status |
|--------|--------|--------|
| Page Load | < 100ms | ✅ |
| TTFB | < 30ms | ✅ |
| Cache Hit Rate | > 90% | ✅ |
| DB Queries/Page | < 5 | ✅ |

---

**🎉 Selamat! Aplikasi Anda sekarang NASA-grade performance!**

Untuk dokumentasi lengkap, lihat: `docs/PERFORMANCE_OPTIMIZATION_GUIDE.md`
