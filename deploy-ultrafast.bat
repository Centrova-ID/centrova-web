@echo off
REM ##############################################
REM WINDOWS DEPLOYMENT SCRIPT
REM Ultra-fast optimization for Laravel on Windows
REM ##############################################

echo [92m========================================[0m
echo [92mULTRA-FAST DEPLOYMENT FOR WINDOWS[0m
echo [92m========================================[0m
echo.

REM Step 1: Pull latest code
echo [96m-^> Pulling latest code...[0m
git pull origin main
if %ERRORLEVEL% NEQ 0 (
    echo [91mGit pull failed![0m
    pause
    exit /b 1
)

REM Step 2: Install PHP dependencies
echo [96m-^> Installing PHP dependencies...[0m
composer install --no-dev --optimize-autoloader --no-interaction
if %ERRORLEVEL% NEQ 0 (
    echo [91mComposer install failed![0m
    pause
    exit /b 1
)

REM Step 3: Clear caches
echo [96m-^> Clearing caches...[0m
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

REM Step 4: Run migrations
echo [96m-^> Running migrations...[0m
php artisan migrate --force

REM Step 5: Cache everything (production mode)
echo [96m-^> Caching configuration...[0m
php artisan config:cache
php artisan event:cache
php artisan view:cache
REM route:cache dilewati — ada duplicate route name 'privacy.request.form'
REM php artisan route:cache

REM Step 6: Optimize autoloader
echo [96m-^> Optimizing autoloader...[0m
composer dump-autoload --optimize --classmap-authoritative

REM Step 7: Build assets
echo [96m-^> Building assets...[0m
call npm ci --production
call npm run build

REM Step 8: Pre-compute data
echo [96m-^> Pre-computing data...[0m
php artisan data:precompute

REM Step 9: Warm cache
echo [96m-^> Warming cache...[0m
php artisan cache:warm

REM Step 10: Run benchmark
echo [96m-^> Running benchmark...[0m
php artisan performance:benchmark --runs=10

echo.
echo [92m========================================[0m
echo [92mDEPLOYMENT COMPLETE![0m
echo [92m========================================[0m
echo.
echo [93mTo start Octane:[0m
echo   php artisan octane:start --server=swoole --workers=4
echo.
echo [93mTo run in production:[0m
echo   php artisan octane:start --server=swoole --workers=8 --max-requests=1000
echo.

pause
