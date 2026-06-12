# Setup Cloudflare Tunnel untuk centrova.id

## Prasyarat
- Domain `centrova.id` sudah terdaftar di Cloudflare
- Akun Cloudflare Zero Trust (gratis tersedia)

---

## Langkah 1: Buat Tunnel di Cloudflare Dashboard

1. Buka https://one.dash.cloudflare.com
2. Pilih akun Anda → **Networks** → **Tunnels**
3. Klik **Create a tunnel**
4. Pilih **Cloudflared** → klik **Next**
5. Beri nama tunnel: `centrova-production`
6. Klik **Save tunnel**
7. Pada halaman berikutnya, salin **Tunnel Token** (format panjang)

---

## Langkah 2: Isi Token di .env

Edit file `.env`:
```
CLOUDFLARE_TUNNEL_TOKEN=eyJhIjoixxxxxxxxxx...  (token dari dashboard)
```

---

## Langkah 3: Konfigurasi Public Hostnames di Dashboard

Setelah tunnel dibuat, tambahkan **Public Hostnames**:

| Subdomain | Domain | Type | URL |
|-----------|--------|------|-----|
| *(kosong)* | centrova.id | HTTP | http://app:80 |
| account | centrova.id | HTTP | http://app:80 |
| office | centrova.id | HTTP | http://app:80 |
| support | centrova.id | HTTP | http://app:80 |
| news | centrova.id | HTTP | http://app:80 |
| developer | centrova.id | HTTP | http://app:80 |
| careers | centrova.id | HTTP | http://app:80 |
| docs | centrova.id | HTTP | http://app:80 |
| learn | centrova.id | HTTP | http://app:80 |

> Semua subdomain diarahkan ke `http://app:80` karena routing subdomain
> ditangani oleh Laravel berdasarkan `Host` header.

---

## Langkah 4: Jalankan Semua Service

```bash
docker compose down -v   # reset data lama
docker compose up -d     # start semua service termasuk cloudflared
```

Cek status:
```bash
docker compose ps
docker logs centrova-cloudflared
```

---

## Langkah 5: Verifikasi

Setelah cloudflared online, buka:
- https://centrova.id
- https://account.centrova.id
- https://office.centrova.id

---

## Troubleshooting

**Tunnel tidak terhubung:**
```bash
docker logs centrova-cloudflared
# Pastikan CLOUDFLARE_TUNNEL_TOKEN sudah diisi di .env
```

**App error 500:**
```bash
docker exec centrova-app tail -50 /var/www/html/storage/logs/laravel.log
```

**Reset database:**
```bash
docker compose down -v && docker compose up -d
```
