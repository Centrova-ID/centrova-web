#!/bin/bash

##############################################
# PRODUCTION DEPLOYMENT SCRIPT - Docker
# Fast redeploy for Centrova Docker setup
##############################################

echo "🚀 Starting fast Docker redeploy..."

cd /var/www/centrova-web

# Step 1: Git pull latest changes
echo "→ Pulling latest code..."
git pull origin main

# Step 2: Build & deploy (fast — uses Docker cache)
echo "→ Building & deploying with Docker..."
docker compose up -d --build app

# Step 3: Wait for startup
echo "→ Waiting for app to be ready..."
sleep 10

# Step 4: Verify deployment
echo "→ Verifying deployment..."
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8080)
if [ "$HTTP_CODE" = "200" ]; then
    echo "✅ Deployment successful! (HTTP $HTTP_CODE)"
else
    echo "⚠️  App returned HTTP $HTTP_CODE — check logs: docker logs centrova-app --tail 20"
fi

echo ""
echo "🚀 Redeploy complete!"
echo "💡 Logs: docker logs centrova-app --tail 50"
echo "💡 Restart: docker compose restart app"
