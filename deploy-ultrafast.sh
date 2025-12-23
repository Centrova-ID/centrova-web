#!/bin/bash

##############################################
# PRODUCTION DEPLOYMENT SCRIPT
# Ultra-fast optimization for Laravel
##############################################

echo "🚀 Starting ultra-fast deployment..."

# Step 1: Stop Octane (if running)
echo "→ Stopping Octane..."
php artisan octane:stop 2>/dev/null || true

# Step 2: Git pull latest changes
echo "→ Pulling latest code..."
git pull origin main

# Step 3: Install dependencies (optimized)
echo "→ Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Step 4: Clear all caches
echo "→ Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Step 5: Run migrations (if any)
echo "→ Running migrations..."
php artisan migrate --force

# Step 6: Run database indexes migration
echo "→ Optimizing database indexes..."
php artisan migrate --path=database/migrations/2024_12_06_000001_add_performance_indexes.php --force

# Step 7: Cache everything
echo "→ Caching application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Step 8: Optimize composer
echo "→ Optimizing composer..."
composer dump-autoload --optimize --classmap-authoritative

# Step 9: Build assets
echo "→ Building assets..."
npm ci --production
npm run build

# Step 10: Pre-compute data
echo "→ Pre-computing data..."
php artisan data:precompute

# Step 11: Warm cache
echo "→ Warming cache..."
php artisan cache:warm

# Step 12: Set permissions
echo "→ Setting permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Step 13: Start Octane (production mode)
echo "→ Starting Octane..."
php artisan octane:start \
    --server=swoole \
    --host=127.0.0.1 \
    --port=8000 \
    --workers=8 \
    --task-workers=4 \
    --max-requests=1000 \
    --watch=false &

# Wait for Octane to start
sleep 3

# Step 14: Verify deployment
echo "→ Verifying deployment..."
curl -s http://127.0.0.1:8000 > /dev/null
if [ $? -eq 0 ]; then
    echo "✅ Deployment successful!"
    echo "🎉 Application is running at ultra-fast speed!"
else
    echo "❌ Deployment verification failed"
    exit 1
fi

# Step 15: Benchmark
echo "→ Running benchmark..."
php artisan performance:benchmark --runs=10

echo ""
echo "🚀 Deployment complete!"
echo "💡 Monitor with: php artisan octane:status"
echo "💡 Logs: tail -f storage/logs/laravel.log"
