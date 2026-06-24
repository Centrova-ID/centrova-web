#!/bin/bash
set -e

echo "==> Setting up Laravel..."

cd /var/www/html

# Ensure storage directories exist (realpath() in config/view.php fails if dir missing)
mkdir -p storage/framework/{views,cache,sessions} storage/logs storage/app/public
mkdir -p bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Generate app key jika belum ada
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
    # Export the newly generated key so config:cache picks it up
    export APP_KEY=$(grep "^APP_KEY=" .env | cut -d'=' -f2-)
fi

# Discover packages (skipped during build since .env wasn't available)
php artisan package:discover --ansi

# Wait for MySQL
echo "==> Waiting for MySQL..."
until php -r "new PDO('mysql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" 2>/dev/null; do
    sleep 2
done
echo "==> MySQL ready."

# Run migrations with 60s timeout — continue on partial failure
set +e
timeout 60 php artisan migrate --force
MIGRATE_EXIT=$?
set -e
if [ $MIGRATE_EXIT -ne 0 ]; then
    echo "==> WARNING: Some migrations failed (exit $MIGRATE_EXIT). App may still work."
fi

# Seed data — insert via raw SQL for reliability
POSTS_COUNT=$(php -r "try{echo new PDO('mysql:host=${DB_HOST};dbname=${DB_DATABASE}','${DB_USERNAME}','${DB_PASSWORD}')->query('SELECT COUNT(*) FROM posts')->fetchColumn();}catch(Exception\$e){echo 0;}")
if [ "$POSTS_COUNT" = "0" ]; then
    php artisan db:seed --class=PostSeeder --force 2>/dev/null || echo "==> Seeder skipped."
fi

# Clear & cache config
php artisan config:cache
# Note: route:cache skipped due to duplicate route name 'privacy.request.form' in main.php & account.php
php artisan view:cache

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
