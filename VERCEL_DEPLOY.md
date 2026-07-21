# 🚀 Deploy Centrova Web ke Vercel

Panduan lengkap untuk mendeploy aplikasi Laravel Centrova Web ke **Vercel** dengan domain **centrova.id**.

---

## 📋 Prasyarat

1. **Akun Vercel** — Daftar di [vercel.com](https://vercel.com) (hubungkan dengan GitHub)
2. **GitHub Repository** — Code sudah di-push ke GitHub (`Centrova-ID/centrova-web`)
3. **Database Eksternal** — Vercel tidak menyediakan MySQL/Redis built-in. Persiapan:
   - **MySQL**: [PlanetScale](https://planetscale.com), [AWS RDS](https://aws.amazon.com/rds/), [Supabase](https://supabase.com), atau [Railway](https://railway.app)
   - **Redis** (opsional): [Upstash](https://upstash.com) atau [Redis Cloud](https://redis.com/redis-enterprise-cloud/)
   - **File Storage**: AWS S3 (sudah terkonfigurasi di `config/filesystems.php`)
4. **Domain centrova.id** — Sudah terdaftar dan bisa di-pointing ke Vercel

---

## 📁 File-File Baru

File-file berikut sudah ditambahkan ke project:

| File | Fungsi |
|------|--------|
| `vercel.json` | Konfigurasi Vercel (PHP runtime, routes, env vars) |
| `api/index.php` | Entry point serverless Vercel untuk Laravel |
| `.vercelignore` | File/folder yang di-exclude dari deployment |
| `VERCEL_DEPLOY.md` | Dokumentasi ini |

---

## ⚙️ Konfigurasi Environment Variables

Setelah connect repository ke Vercel, tambahkan **Environment Variables** berikut di Vercel Dashboard:

### Required (Wajib)

| Variable | Value | Keterangan |
|----------|-------|------------|
| `APP_KEY` | *(generate dengan `php artisan key:generate`)* | Encryption key Laravel |
| `APP_ENV` | `production` | Environment mode |
| `APP_URL` | `https://centrova.id` | URL aplikasi |
| `APP_DEBUG` | `false` | Debug mode |

### Database (MySQL)

| Variable | Value |
|----------|-------|
| `DB_CONNECTION` | `mysql` |
| `DB_HOST` | *(host database eksternal)* |
| `DB_PORT` | `3306` |
| `DB_DATABASE` | *(nama database)* |
| `DB_USERNAME` | *(username database)* |
| `DB_PASSWORD` | *(password database)* |

### Session & Cache (Gunakan database driver)

| Variable | Value |
|----------|-------|
| `SESSION_DRIVER` | `database` |
| `SESSION_SECURE_COOKIE` | `true` |
| `CACHE_DRIVER` | `database` atau `redis` |

> **Catatan**: Session file-based **tidak akan bekerja** di serverless. Vercel tidak memiliki shared filesystem. Gunakan `database` driver.

### AWS S3 (File Storage)

| Variable | Value |
|----------|-------|
| `FILESYSTEM_DISK` | `s3` |
| `AWS_ACCESS_KEY_ID` | *(AWS key)* |
| `AWS_SECRET_ACCESS_KEY` | *(AWS secret)* |
| `AWS_DEFAULT_REGION` | `ap-southeast-1` |
| `AWS_BUCKET` | *(nama bucket S3)* |

### Opsional — Redis

| Variable | Value |
|----------|-------|
| `CACHE_DRIVER` | `redis` |
| `REDIS_CLIENT` | `predis` |
| `REDIS_HOST` | *(host Upstash/Redis Cloud)* |
| `REDIS_PASSWORD` | *(password redis)* |
| `REDIS_PORT` | `6379` |

### Mail

| Variable | Value |
|----------|-------|
| `MAIL_MAILER` | `smtp` |
| `MAIL_HOST` | *(SMTP host)* |
| `MAIL_PORT` | `587` |
| `MAIL_USERNAME` | *(SMTP username)* |
| `MAIL_PASSWORD` | *(SMTP password)* |
| `MAIL_FROM_ADDRESS` | `hello@centrova.id` |
| `MAIL_FROM_NAME` | `Centrova` |

### Domain Reseller (jika digunakan)

| Variable | Value |
|----------|-------|
| `DOMAIN_API_KEY` | *(API key)* |
| `DOMAIN_RESELLER_ID` | *(reseller ID)* |

---

## 🛠️ Langkah-Langkah Deploy

### 1. Push Code ke GitHub

```bash
git add .
git commit -m "feat: add Vercel deployment config"
git push origin main
```

### 2. Import Project ke Vercel

1. Buka [vercel.com/new](https://vercel.com/new)
2. Pilih repository `Centrova-ID/centrova-web`
3. **Framework Preset**: Pilih `Other` (bukan Laravel — karena kita pakai PHP runtime kustom)
4. **Root Directory**: `./` (default)
5. **Build & Output Settings**: Biarkan default (Vercel akan membaca `vercel.json`)
6. Klik **Deploy**

### 3. Konfigurasi Environment Variables

Setelah import, Vercel akan menampilkan halaman **Environment Variables**. Tambahkan semua variable dari tabel di atas.

### 4. Generate APP_KEY

```bash
# Generate key lokal
php artisan key:generate --show
# Salin output-nya dan set sebagai APP_KEY di Vercel dashboard
```

### 5. Deploy Production

Setelah environment variables terisi, klik **Deploy**. Vercel akan:
1. Install Composer dependencies
2. Jalankan `npm ci && npm run build` (build Vite assets)
3. Cache Laravel config, routes, events, dan views
4. Deploy PHP serverless function

### 6. Setup Domain

1. Di Vercel Dashboard → project → **Settings** → **Domains**
2. Tambahkan `centrova.id`
3. Ikuti instruksi Vercel untuk mengubah nameserver DNS centrova.id ke Vercel:
   - `dns1.registrar-servers.com`
   - `dns2.registrar-servers.com`
4. (Alternatif) Jika pakai domain custom DNS, tambahkan `CNAME` record ke `cname.vercel-dns.com`

---

## 🔄 Redeploy Otomatis

Vercel otomatis mendeploy ulang setiap kali ada push ke branch `main` (default). Untuk mendeploy ulang manual:

1. Buka Vercel Dashboard
2. Project → **Deployments**
3. Klik tombol **...** → **Redeploy**

Atau via CLI:

```bash
npx vercel --prod
```

---

## 🧪 Deploy Preview (Staging)

Setiap pull request akan otomatis mendapat URL preview unik:
`https://centrova-web-git-feature-xxx.vercel.app`

Gunakan ini untuk testing sebelum merge ke main.

---

## ⚠️ Keterbatasan & Catatan Penting

### Yang Perlu Diperhatikan di Vercel

1. **❌ File-based storage tidak bekerja**
   - Session, cache, logs tidak bisa pakai file driver
   - Session → gunakan `database` driver
   - Cache → gunakan `database` atau `redis`
   - Logs → gunakan `stderr` (sudah di-set di `vercel.json`)

2. **❌ File uploads (local) tidak bekerja**
   - Gunakan AWS S3 (sudah terkonfigurasi)
   - Profile picture, dll harus langsung upload ke S3

3. **❌ Artisan commands (scheduled tasks) tidak jalan**
   - Cron job tidak bisa jalan di serverless
   - Solusi: Gunakan [Vercel Cron Jobs](https://vercel.com/docs/cron-jobs) atau external scheduler

4. **⚠️ Cold start**
   - Request pertama setelah idle bisa lambat (cold start ~250ms)
   - Request berikutnya cepat (~5-10ms)
   - Solusi: Setup [Vercel cron job](https://vercel.com/docs/cron-jobs) untuk ping tiap 5 menit

5. **⚠️ Subdomain routing (account.centrova.id)**
   - Vercel mendukung subdomain via `vercel.json` rewrites
   - Semua subdomain perlu ditambahkan di Vercel Dashboard → Domains

### Development Lokal

Jalankan Laravel seperti biasa:

```bash
# Laravel dev server
php artisan serve

# Vite dev
npm run dev

# Atau keduanya
npm run serve
```

Untuk testing Vercel deployment lokal:

```bash
# Install Vercel CLI
npm i -g vercel

# Build lokal (butuh PHP + Composer terinstall)
vercel build

# Preview lokal
vercel dev
```

---

## 📊 Monitoring & Logs

- **Logs**: Vercel Dashboard → Project → **Functions** → Logs
- **Metrics**: Vercel Dashboard → Project → **Analytics**
- **Error Tracking**: Integrasikan dengan [Sentry](https://sentry.io) untuk Laravel

---

## 🏗️ Arsitektur Deployment

```
GitHub Push → Vercel Trigger
     ↓
Composer Install
     ↓
npm Install & Vite Build (CSS, JS)
     ↓
Laravel Cache (config, routes, events, views)
     ↓
Deploy ke Vercel Edge Network
     ↓
Request → Vercel CDN → api/index.php (PHP 8.5)
                         ↓
                   Static file? → Ya   → Serve langsung
                         ↓ Tidak
                   public/index.php (Laravel)
                         ↓
                   MySQL Eksternal ← Database
                   AWS S3            ← File Storage
                   Redis Eksternal   ← Cache/Session
```

---

## 🔧 Troubleshooting

### Error: "Class '...' not found"
Pastikan `composer install` berhasil. Cek logs Vercel.

### Error: "Connection refused" database
Pastikan database eksternal mengizinkan koneksi dari IP publik Vercel (non-restricted).

### Error: "No application encryption key"
Set `APP_KEY` di environment variables Vercel. Generate dengan `php artisan key:generate --show`.

### Error: 500 Internal Server
Cek logs Vercel. Biasanya karena missing env var atau database connection.

### Error: "Session store not set on request"
Session driver harus `database`, bukan `file`. Set `SESSION_DRIVER=database` di Vercel.

---

## 📚 Referensi

- [vercel-php — PHP Runtime for Vercel](https://github.com/vercel-community/php)
- [Vercel Documentation](https://vercel.com/docs)
- [Laravel Deployment](https://laravel.com/docs/10.x/deployment)
- [Deploy Laravel on Vercel (iagobruno)](https://github.com/iagobruno/laravel-on-vercel)
