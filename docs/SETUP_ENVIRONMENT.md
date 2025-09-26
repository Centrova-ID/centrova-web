# Setup Environment Laravel - Centrova Retail

Dokumentasi ini menjelaskan langkah-langkah setup environment development untuk website Centrova Retail menggunakan Laravel framework.

## 📋 Requirements

### Software yang Diperlukan
- **Laravel Herd** (dengan Valet) - untuk local development server
- **Laragon** - untuk database management dan PHP environment
- **Git** - untuk version control
- **Node.js** (v18+) dan npm - untuk frontend dependencies
- **Composer** - untuk PHP dependency management

### Spesifikasi Minimum
- PHP 8.1 atau lebih tinggi
- MySQL 8.0+
- Node.js 18+
- RAM minimal 4GB
- Storage minimal 2GB free space

## 🚀 Langkah-Langkah Setup

### 1. Install Prerequisites

#### A. Install Laravel Herd
1. Download Laravel Herd dari [https://herd.laravel.com/](https://herd.laravel.com/)
2. Install sesuai petunjuk untuk Windows
3. Pastikan Valet sudah aktif dengan menjalankan:
   ```bash
   herd --version
   ```

#### B. Install Laragon
1. Download Laragon dari [https://laragon.org/](https://laragon.org/)
2. Install dengan konfigurasi:
   - PHP 8.1+
   - MySQL 8.0+
   - Apache/Nginx
3. Start Laragon dan pastikan services MySQL berjalan

#### C. Install Git
1. Download dari [https://git-scm.com/](https://git-scm.com/)
2. Install dengan konfigurasi default

### 2. Clone Repository

```bash
# Clone repository
git clone https://github.com/tanbopp/centrova-retail.git

# Masuk ke folder project
cd centrova-retail
```

### 3. Setup PHP Dependencies

```bash
# Install Composer dependencies
composer install

# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database

#### A. Buat Database di Laragon
1. Buka Laragon
2. Start All services
3. Klik "Database" atau buka phpMyAdmin
4. Buat database baru dengan nama: `centrova_account`

#### B. Import Database Schema
1. Buka phpMyAdmin atau database client lainnya
2. Pilih database `centrova_account`
3. Import file: `setup_db/centrova_account.sql`

#### C. Konfigurasi Database di .env
Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=centrova_account
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan:** Sesuaikan `DB_PASSWORD` dengan password MySQL Laragon Anda jika ada.

### 5. Setup Frontend Dependencies

```bash
# Install Node.js dependencies
npm install

# Build assets untuk development
npm run dev
```

### 6. Setup Laravel Herd/Valet

Aplikasi Centrova menggunakan **subdomain-based routing**, jadi perlu setup khusus untuk Valet/Herd:

```bash
# Park directory untuk auto-discovery
herd park

# Link project dengan nama centrova
herd link centrova

# Set secure (HTTPS) - opsional tetapi direkomendasikan
herd secure centrova
```

**Subdomain yang akan tersedia:**
- `centrova.test` - Main domain (homepage, about, contact, services)
- `account.centrova.test` - User account management
- `support.centrova.test` - Customer support dan chat
- `office.centrova.test` - Staff/admin dashboard
- `news.centrova.test` - News portal
- `docs.centrova.test` - Documentation
- `developer.centrova.test` - Developer resources
- `careers.centrova.test` - Career portal
- `learn.centrova.test` - Learning platform

**Catatan Penting:**
- Pastikan semua subdomain dapat diakses setelah setup Valet
- Jika ada masalah dengan subdomain, restart Herd: `herd restart`
- Untuk development, buka https://centrova.test (main domain) terlebih dahulu

### 7. Konfigurasi Environment

Edit file `.env` untuk menyesuaikan dengan setup lokal:

```env
APP_NAME=Centrova
APP_ENV=local
APP_KEY=base64:6ZVLznGc6GNyNKGrXCbkwM6j8+RigvSK6zJhqmTUze8=
APP_DEBUG=true
APP_URL=http://centrova.test
SESSION_DOMAIN=.centrova.test

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=centrova_account
DB_USERNAME=root
DB_PASSWORD=

# Session Configuration
SESSION_DRIVER=database
SESSION_CONNECTION=account
SESSION_LIFETIME=120

# Cache & Queue
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Mail Configuration (untuk development)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@centrova.test"
MAIL_FROM_NAME="${APP_NAME}"
```

### 8. Migrate Database

```bash
# Jalankan migrasi database
php artisan migrate

# Jika ada seeder, jalankan juga
php artisan db:seed
```

### 9. Setup Storage Links

```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

### 10. Clear Cache

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk development
php artisan config:cache
```

## 🔧 Development Workflow

### Menjalankan Development Server

#### Opsi 1: Menggunakan Laravel Herd/Valet (Recommended)
```bash
# Akses melalui subdomain yang tersedia:
# Main domain
https://centrova.test

# Subdomain untuk fitur khusus
https://account.centrova.test    # User account management
https://support.centrova.test    # Customer support & chat
https://office.centrova.test     # Staff/admin dashboard
https://news.centrova.test       # News portal
https://docs.centrova.test       # Documentation
https://developer.centrova.test  # Developer resources
https://careers.centrova.test    # Career portal
https://learn.centrova.test      # Learning platform
```

#### Opsi 2: Menggunakan Artisan Serve
```bash
# Terminal 1: Jalankan Laravel development server
php artisan serve

# Terminal 2: Jalankan Vite untuk asset compilation
npm run dev
```

#### Opsi 3: Menggunakan npm script (Recommended)
```bash
# Jalankan Laravel server dan Vite secara bersamaan
npm run serve
```

### File Watching untuk Development

```bash
# Watch files untuk auto-compilation
npm run dev

# Atau untuk production build
npm run build
```

## 📁 Struktur Project Penting

```
centrova-retail/
├── app/                    # Core application code
│   ├── Http/Controllers/   # Controllers
│   ├── Models/            # Eloquent models
│   ├── Services/          # Business logic services
│   └── Helpers/           # Helper classes
├── config/                # Configuration files
├── database/              # Database files
│   ├── migrations/        # Database migrations
│   ├── seeders/          # Database seeders
│   └── sql/              # SQL dumps
├── public/                # Web accessible files
├── resources/             # Views, CSS, JS
│   ├── views/            # Blade templates
│   ├── css/              # Stylesheets
│   └── js/               # JavaScript files
├── routes/                # Route definitions
├── setup_db/             # Database setup files
└── storage/              # File storage
```

## 🔍 Troubleshooting

### Common Issues

#### 1. Permission Errors
```bash
# Set proper permissions (on Windows with WSL)
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

#### 2. Database Connection Error
- Pastikan Laragon MySQL service berjalan
- Cek kredensial database di file `.env`
- Verifikasi database `centrova_account` sudah dibuat

#### 3. Asset Compilation Issues
```bash
# Clear node modules dan reinstall
rm -rf node_modules/
npm install
npm run dev
```

#### 4. Valet/Herd Not Working
```bash
# Restart Herd
herd restart

# Cek status Valet
herd status

# Untuk masalah subdomain, coba unlink dan link ulang
herd unlink centrova
herd link centrova

# Atau install ulang Valet
herd install
```

#### 5. Subdomain Not Accessible
```bash
# Clear DNS cache (Windows)
ipconfig /flushdns

# Restart Herd setelah clear DNS
herd restart

# Pastikan .test domain tidak conflict dengan DNS lain
```

#### 5. PHP Version Issues
- Pastikan menggunakan PHP 8.1+
- Di Laragon, pilih PHP version yang sesuai
- Restart semua services setelah ganti PHP version

### Debugging Tips

#### Check System Status
```bash
# Check PHP version
php --version

# Check Composer
composer --version

# Check Node.js
node --version
npm --version

# Check Laravel
php artisan --version

# Check database connection
php artisan tinker
# Kemudian di tinker console:
# DB::connection()->getPdo();
```

#### Logs Location
- Laravel logs: `storage/logs/laravel.log`
- Herd logs: Check Herd application
- Laragon logs: Laragon folder/logs

## 🚀 Ready to Develop!

Setelah semua langkah di atas selesai, Anda dapat:

1. **Akses website utama** di `https://centrova.test`
2. **Test semua subdomain** sesuai fitur yang ingin dikembangkan:
   - `https://account.centrova.test` - untuk development fitur account
   - `https://support.centrova.test` - untuk development fitur support & chat  
   - `https://office.centrova.test` - untuk development staff dashboard
   - Dan subdomain lainnya sesuai kebutuhan
3. **Edit code** di folder `app/`, `resources/`, dan `routes/`
4. **Database management** melalui phpMyAdmin di Laragon
5. **Watch assets** dengan `npm run dev`

### Testing Subdomain
Untuk memastikan semua subdomain berfungsi dengan baik:

```bash
# Test main domain
curl https://centrova.test

# Test account subdomain  
curl https://account.centrova.test

# Test support subdomain
curl https://support.centrova.test
```

## 📞 Support

Jika mengalami masalah dalam setup, silakan:
1. Cek documentation Laravel: [https://laravel.com/docs](https://laravel.com/docs)
2. Cek documentation Herd: [https://herd.laravel.com/docs](https://herd.laravel.com/docs)
3. Buka issue di repository ini

---

**Happy Coding! 🎉**

*Dokumentasi ini dibuat untuk memastikan semua developer Centrova dapat setup environment dengan mudah dan konsisten.*
