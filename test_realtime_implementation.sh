#!/bin/bash

# Real-time Account Data Testing Script
echo "🚀 Testing Real-time Account Data Implementation"
echo "================================================"

# Navigate to project directory
cd "d:/Centrova/landing-page/centrova-retail"

echo "✅ Step 1: Clear all caches"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "✅ Step 2: Check route registration"
echo "API Routes:"
php artisan route:list --name=api | grep -E "(security-score|device-data|recent-activities)"

echo "✅ Step 3: Validate service classes"
echo "Checking if classes can be instantiated..."

# Test if services can be instantiated (basic syntax check)
php -r "
require_once 'vendor/autoload.php';
\$app = require_once 'bootstrap/app.php';
\$kernel = \$app->make(Illuminate\Contracts\Console\Kernel::class);
\$kernel->bootstrap();

try {
    echo 'SecurityScoreService: ';
    \$service = app(App\Services\SecurityScoreService::class);
    echo 'OK\n';
    
    echo 'RealTimeDeviceService: ';
    \$service = app(App\Services\RealTimeDeviceService::class);
    echo 'OK\n';
    
    echo 'AccountDataCacheService: ';
    \$service = app(App\Services\AccountDataCacheService::class);
    echo 'OK\n';
    
} catch (Exception \$e) {
    echo 'ERROR: ' . \$e->getMessage() . '\n';
}
"

echo "✅ Step 4: Test database connections"
php artisan migrate:status --database=account

echo "✅ Step 5: Check if cache command is available"
php artisan cache:clear-expired --help 2>/dev/null && echo "Cache command available" || echo "Cache command needs registration"

echo ""
echo "🎯 Implementation Summary:"
echo "- SecurityScoreService: Comprehensive security scoring with caching"
echo "- RealTimeDeviceService: Real-time device tracking and session management"
echo "- AccountDataCacheService: Optimized data caching for account overview"
echo "- JavaScript auto-refresh: 30-second intervals with visibility API"
echo "- API endpoints: /api/security-score, /api/device-data, /api/recent-activities"
echo "- Performance: Cached responses with intelligent invalidation"
echo ""
echo "🔧 Next Steps:"
echo "1. Test the account page in browser"
echo "2. Check browser console for auto-refresh logs"
echo "3. Verify API endpoints return proper JSON"
echo "4. Monitor cache performance in production"
echo ""
echo "✨ Real-time account data implementation complete!"
