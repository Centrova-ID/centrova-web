#!/bin/bash

# Script untuk mengoptimasi performa halaman account
# Centrova Retail - Database Index Optimization

echo "=== Centrova Retail - Account Page Database Optimization ==="
echo "Starting optimization process..."
echo ""

# Check if we're in Laravel root directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: Please run this script from Laravel root directory"
    exit 1
fi

# Backup database sebelum migration (optional)
echo "📦 Creating database backup..."
read -p "Do you want to create database backup first? (y/n): " backup_choice

if [[ $backup_choice == "y" || $backup_choice == "Y" ]]; then
    backup_filename="backup_before_account_optimization_$(date +%Y%m%d_%H%M%S).sql"
    
    # Get database config from Laravel
    DB_HOST=$(php artisan tinker --execute="echo config('database.connections.mysql.host');" | tail -1)
    DB_DATABASE=$(php artisan tinker --execute="echo config('database.connections.mysql.database');" | tail -1)
    DB_USERNAME=$(php artisan tinker --execute="echo config('database.connections.mysql.username');" | tail -1)
    
    echo "Creating backup: $backup_filename"
    
    # Prompt for password
    read -s -p "Enter database password: " DB_PASSWORD
    echo ""
    
    mysqldump -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" > "$backup_filename"
    
    if [ $? -eq 0 ]; then
        echo "✅ Backup created successfully: $backup_filename"
    else
        echo "❌ Backup failed! Please check your database credentials."
        exit 1
    fi
fi

echo ""

# Check current migration status
echo "🔍 Checking current migration status..."
php artisan migrate:status | grep -E "(add_indexes_for_account|add_covering_indexes)"

echo ""

# Run performance test before optimization
echo "📊 Running performance test BEFORE optimization..."
php artisan monitor:account-performance --iterations=5 > performance_before.txt 2>&1

if [ $? -eq 0 ]; then
    echo "✅ Before optimization test completed"
    echo "📁 Results saved to: performance_before.txt"
else
    echo "⚠️  Before optimization test had issues, but continuing..."
fi

echo ""

# Run migrations
echo "🚀 Running database migrations..."
php artisan migrate --force

if [ $? -eq 0 ]; then
    echo "✅ Migrations completed successfully"
else
    echo "❌ Migration failed! Check the error above."
    exit 1
fi

echo ""

# Verify index creation
echo "🔍 Verifying index creation..."
php artisan tinker --execute="
use Illuminate\Support\Facades\DB;

echo \"=== DEVICES TABLE INDEXES ===\";
\$indexes = DB::select('SHOW INDEX FROM devices');
foreach(\$indexes as \$idx) {
    if(strpos(\$idx->Key_name, 'idx_devices') !== false) {
        echo \"✅ {\$idx->Key_name} on column: {\$idx->Column_name}\";
    }
}

echo \"\n=== SUBSCRIPTIONS TABLE INDEXES ===\";
\$indexes = DB::select('SHOW INDEX FROM subscriptions');
foreach(\$indexes as \$idx) {
    if(strpos(\$idx->Key_name, 'idx_subscriptions') !== false) {
        echo \"✅ {\$idx->Key_name} on column: {\$idx->Column_name}\";
    }
}

echo \"\n=== SERVICE_ORDERS TABLE INDEXES ===\";
\$indexes = DB::select('SHOW INDEX FROM service_orders');
foreach(\$indexes as \$idx) {
    if(strpos(\$idx->Key_name, 'idx_service_orders') !== false) {
        echo \"✅ {\$idx->Key_name} on column: {\$idx->Column_name}\";
    }
}
"

echo ""

# Wait a moment for MySQL to update statistics
echo "⏳ Waiting for MySQL to update index statistics..."
sleep 3

# Run performance test after optimization
echo "📊 Running performance test AFTER optimization..."
php artisan monitor:account-performance --iterations=5 > performance_after.txt 2>&1

if [ $? -eq 0 ]; then
    echo "✅ After optimization test completed"
    echo "📁 Results saved to: performance_after.txt"
else
    echo "⚠️  After optimization test had issues"
fi

echo ""

# Analyze and compare results
echo "📈 Performance comparison:"
echo ""
echo "=== BEFORE OPTIMIZATION ==="
if [ -f "performance_before.txt" ]; then
    tail -10 performance_before.txt
else
    echo "Before optimization data not available"
fi

echo ""
echo "=== AFTER OPTIMIZATION ==="
if [ -f "performance_after.txt" ]; then
    tail -10 performance_after.txt
else
    echo "After optimization data not available"
fi

echo ""

# Clear application cache
echo "🧹 Clearing application cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "✅ Cache cleared"

echo ""

# Update composer autoload
echo "🔄 Updating Composer autoload..."
composer dump-autoload --optimize

echo ""

# Final recommendations
echo "🎯 OPTIMIZATION COMPLETED!"
echo ""
echo "📋 Next Steps:"
echo "1. Monitor your application performance in production"
echo "2. Consider implementing the AccountControllerOptimized.php with caching"
echo "3. Set up slow query monitoring in MySQL"
echo "4. Review the performance test results in performance_*.txt files"
echo ""

echo "📊 Monitoring Commands:"
echo "• Monitor account performance: php artisan monitor:account-performance"
echo "• Check slow queries: SHOW PROCESSLIST; (in MySQL)"
echo "• Analyze query plans: EXPLAIN [your-query]; (in MySQL)"
echo ""

echo "🗃️ Files created:"
echo "• performance_before.txt - Performance before optimization"
echo "• performance_after.txt - Performance after optimization"
if [[ $backup_choice == "y" || $backup_choice == "Y" ]]; then
    echo "• $backup_filename - Database backup"
fi

echo ""
echo "✨ Account page optimization is now complete!"

# Optional: Run a quick test
read -p "Would you like to run a quick account page test? (y/n): " test_choice

if [[ $test_choice == "y" || $test_choice == "Y" ]]; then
    echo ""
    echo "🧪 Running quick test..."
    php artisan monitor:account-performance --iterations=3
fi

echo ""
echo "🎉 All done! Your account page should now load much faster."
