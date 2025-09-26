# Optimasi Database untuk Halaman Account

## Overview
Halaman account menampilkan berbagai informasi user yang memerlukan query ke beberapa tabel. Untuk meningkatkan performa, telah dibuat index-index strategis dan optimasi query.

## Query yang Dioptimasi

### 1. Devices Table
**Query asli:**
```sql
SELECT * FROM devices WHERE user_id = ? ORDER BY last_active_at DESC
```

**Index yang ditambahkan:**
- `idx_devices_user_last_active` (user_id, last_active_at) - Composite index
- `idx_devices_last_active` (last_active_at) - Single column index

### 2. Subscriptions Table
**Query asli:**
```sql
SELECT * FROM subscriptions WHERE user_id = ? ORDER BY created_at DESC LIMIT 1
```

**Index yang ditambahkan:**
- `idx_subscriptions_user_created` (user_id, created_at) - Composite index
- `idx_subscriptions_status` (status) - Single column index
- `idx_subscriptions_user_latest_coverage` (user_id, created_at, plan, status) - Covering index

### 3. Service Orders Table
**Query asli:**
```sql
-- Query untuk active orders
SELECT COUNT(*) FROM service_orders WHERE user_id = ? AND status IN ('pending', 'in_progress', 'development')

-- Query untuk total orders
SELECT COUNT(*) FROM service_orders WHERE user_id = ?
```

**Query yang dioptimasi:**
```sql
SELECT 
    COUNT(*) as total_orders,
    SUM(CASE WHEN status IN ('pending', 'in_progress', 'development') THEN 1 ELSE 0 END) as active_orders
FROM service_orders 
WHERE user_id = ?
```

**Index yang ditambahkan:**
- `idx_service_orders_user_status` (user_id, status) - Composite index
- `idx_service_orders_user_status_coverage` (user_id, status, created_at) - Covering index

### 4. User Login Activities Table
**Query asli:**
```sql
SELECT * FROM user_login_activities WHERE user_id = ? ORDER BY login_at DESC LIMIT 5
```

**Index yang sudah ada:**
- `(user_id, login_at)` - Sudah optimal

## Optimasi Tambahan

### 1. Caching Strategy
- Cache data account selama 5 menit
- Pisahkan data yang bisa di-cache vs real-time data
- Cache key: `account_data_user_{user_id}`

### 2. Query Optimization
- Gunakan `SELECT` dengan kolom spesifik (bukan `SELECT *`)
- Gabungkan multiple COUNT queries menjadi single query
- Limit hasil devices ke 10 terbaru saja
- Gunakan covering indexes untuk menghindari key lookups

### 3. Controller Optimization
- Buat method `accountOptimized()` dengan caching
- Pisahkan logic untuk cached data vs real-time data
- Tambahkan method `clearAccountCache()` untuk invalidation

## Migration Files

1. **2024_08_31_100000_add_indexes_for_account_page_performance.php**
   - Index dasar untuk semua tabel yang digunakan

2. **2024_08_31_100001_add_covering_indexes_for_account_optimization.php**
   - Covering indexes untuk optimasi lebih lanjut
   - Partial indexes untuk MySQL (jika supported)

## Cara Menjalankan

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. Verify Index Creation
```sql
-- Check devices table indexes
SHOW INDEX FROM devices;

-- Check subscriptions table indexes  
SHOW INDEX FROM subscriptions;

-- Check service_orders table indexes
SHOW INDEX FROM service_orders;
```

### 3. Monitor Query Performance
```sql
-- Enable slow query log (MySQL)
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 0.1;

-- Check query execution plan
EXPLAIN SELECT * FROM devices WHERE user_id = 1 ORDER BY last_active_at DESC;
```

## Expected Performance Improvements

### Before Optimization
- Devices query: ~50-100ms (table scan)
- Subscriptions query: ~30-50ms (table scan)  
- Service orders queries: ~80-120ms (2 separate queries)
- **Total: ~160-270ms**

### After Optimization
- Devices query: ~5-10ms (index lookup)
- Subscriptions query: ~3-5ms (covering index)
- Service orders query: ~5-8ms (single optimized query)
- **Total: ~13-23ms (85-90% improvement)**

## Cache Performance
- First load: ~13-23ms (with database queries)
- Cached loads: ~1-3ms (from cache)
- Cache invalidation: Manual via `clearAccountCache()`

## Monitoring

### 1. Database Performance
```sql
-- Monitor slow queries
SELECT * FROM mysql.slow_log WHERE sql_text LIKE '%devices%' OR sql_text LIKE '%subscriptions%';

-- Check index usage
SELECT * FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_NAME IN ('devices', 'subscriptions', 'service_orders');
```

### 2. Application Performance
```php
// Add timing to controller
$start = microtime(true);
// ... queries
$duration = microtime(true) - $start;
Log::info("Account page load time: {$duration}ms");
```

### 3. Cache Hit Rate
```php
// Monitor cache effectiveness
$cacheKey = "account_data_user_{$userId}";
$hit = Cache::has($cacheKey) ? 'HIT' : 'MISS';
Log::info("Account cache: {$hit}");
```

## Rollback Plan

Jika ada masalah dengan index:
```bash
php artisan migrate:rollback --step=2
```

## Maintenance

### 1. Cache Warming
```php
// Artisan command untuk warm up cache
php artisan cache:warm-account-data
```

### 2. Index Maintenance
```sql
-- Analyze table statistics (MySQL)
ANALYZE TABLE devices, subscriptions, service_orders;

-- Check index fragmentation
SELECT * FROM INFORMATION_SCHEMA.INNODB_SYS_INDEXES WHERE NAME LIKE '%devices%';
```

## Notes

1. **Index Size**: Monitor disk space usage karena index akan menambah storage requirement
2. **Write Performance**: Index dapat sedikit menurunkan performa INSERT/UPDATE, tapi benefit read performance jauh lebih besar
3. **Cache Invalidation**: Pastikan cache di-clear saat ada update pada data user
4. **Monitoring**: Set up alerting untuk slow queries dan cache miss rates
