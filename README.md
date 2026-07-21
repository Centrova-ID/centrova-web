# Centrova Web

**Centrova** — AI Venture Engineering Company. Website resmi Centrova.

## Tech Stack

- **Backend**: Laravel 10 (PHP 8.1+)
- **Frontend**: Blade + Tailwind CSS v4 + Alpine.js
- **Build**: Vite + PostCSS
- **Database**: MySQL
- **Cache**: Redis
- **Storage**: AWS S3
- **Container**: Docker + Nginx

## Development

```bash
# Copy env
cp .env.example .env

# Install dependencies
composer install
npm install

# Build assets
npm run build

# Run dev server
php artisan serve
npm run dev
```

## Deployment

### VPS (Current — Docker)
```bash
bash deploy-ultrafast.sh
```

### Vercel (Alternative)
Lihat [VERCEL_DEPLOY.md](./VERCEL_DEPLOY.md) untuk panduan lengkap deploy ke Vercel.

Project sudah siap deploy ke Vercel dengan domain **centrova.id**.
Cukup push ke GitHub, import di Vercel, dan set environment variables.