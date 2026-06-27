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

# Skip migrate & seed — use existing DB state
set +e
echo "==> Cache config & views..."
php artisan config:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true
set -e
php artisan config:cache
# Note: route:cache skipped due to duplicate route name 'privacy.request.form' in main.php & account.php
php artisan view:cache

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
