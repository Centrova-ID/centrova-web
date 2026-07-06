FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev libfreetype6-dev libjpeg62-turbo-dev libwebp-dev \
    libmagickwand-dev nodejs npm nginx supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache dom

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP dependencies before copying app code so vendor can be reused
# when only application files change.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-scripts --no-autoloader

# Install Node dependencies before copying app code so node_modules can be reused
# when package-lock.json is unchanged.
COPY package.json package-lock.json ./
RUN npm ci

# Copy app files
COPY . .

# Remove stale Laravel caches that may exist in a deploy checkout.
RUN rm -f bootstrap/cache/config.php bootstrap/cache/routes*.php

# Ensure cache/storage dirs exist before runtime artisan commands
RUN mkdir -p bootstrap/cache storage/app/public storage/framework/{sessions,views,cache} storage/logs \
    && chmod -R 775 bootstrap/cache storage

# Build optimized autoload files after app code is available.
RUN composer dump-autoload --optimize --no-dev --no-scripts

# Build assets, then remove build-only Node dependencies from the final image.
RUN npm run build && rm -rf node_modules

# Fix storage permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy configs
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
