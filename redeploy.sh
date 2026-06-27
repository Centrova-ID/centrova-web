#!/bin/bash
# ==============================================
# REDEPLOY CEPAT - Centrova Docker
# Cukup jalankan: bash redeploy.sh
# ==============================================

set -e

echo "🚀 Redeploy Centrova Web..."
echo ""

cd /var/www/centrova-web

# 1. Git pull (hanya file yang berubah)
echo "📥 Pull latest code..."
git pull origin main

# 2. Build & deploy (pakai cache, cepat)
echo "🐳 Build & deploy Docker..."
docker compose up -d --build app

# 3. Tunggu sebentar
echo "⏳ Waiting for app..."
sleep 12

# 4. Cek hasil
echo "🔍 Checking status..."
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8080)
echo "   HTTP Status: $HTTP_CODE"

if [ "$HTTP_CODE" = "200" ] || [ "$HTTP_CODE" = "301" ] || [ "$HTTP_CODE" = "302" ]; then
    echo "✅ Redeploy berhasil!"
else
    echo "⚠️  HTTP $HTTP_CODE — cek log:"
    echo "   docker logs centrova-app --tail 20"
fi

echo ""
echo "📋 Log: docker logs centrova-app --tail 50"
