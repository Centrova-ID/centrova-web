@echo off
REM Centrova Team Workflow Helper - Windows Version
REM Simpan sebagai workflow.bat dan jalankan: workflow.bat [command]

if "%1"=="start" (
    echo 🚀 Memulai hari kerja...
    git checkout recovery-branch
    git pull origin recovery-branch
    echo ✅ Branch recovery-branch sudah update!
    echo 📋 Commit terbaru:
    git log --oneline -5
    goto :eof
)

if "%1"=="new" (
    if "%2"=="" (
        echo ❌ Error: Nama fitur harus diisi!
        echo 💡 Contoh: workflow.bat new payment-system
        goto :eof
    )
    echo 🔧 Membuat fitur baru: %2
    git checkout recovery-branch
    git pull origin recovery-branch
    git checkout -b "feature/%2"
    echo ✅ Branch feature/%2 siap digunakan!
    goto :eof
)

if "%1"=="save" (
    if "%2"=="" (
        echo ❌ Error: Commit message harus diisi!
        echo 💡 Contoh: workflow.bat save "tambah form login"
        goto :eof
    )
    echo 💾 Menyimpan progress...
    git add .
    git commit -m "progress: %~2"
    for /f %%i in ('git branch --show-current') do set CURRENT_BRANCH=%%i
    git push origin %CURRENT_BRANCH%
    echo ✅ Progress tersimpan di branch %CURRENT_BRANCH%!
    goto :eof
)

if "%1"=="finish" (
    if "%2"=="" (
        echo ❌ Error: Commit message harus diisi!
        echo 💡 Contoh: workflow.bat finish "selesai payment system"
        goto :eof
    )
    echo 🏁 Menyelesaikan fitur...
    for /f %%i in ('git branch --show-current') do set CURRENT_BRANCH=%%i
    
    git add .
    git commit -m "feat: %~2"
    git checkout recovery-branch
    git pull origin recovery-branch
    git merge %CURRENT_BRANCH%
    git push origin recovery-branch
    
    echo ✅ Fitur berhasil di-merge ke recovery-branch!
    echo 🗑️  Hapus branch fitur? (y/n)
    set /p response=
    if /i "%response%"=="y" (
        git branch -d %CURRENT_BRANCH%
        echo 🗑️  Branch %CURRENT_BRANCH% dihapus
    )
    goto :eof
)

if "%1"=="update" (
    echo 🔄 Mengambil update dari teman...
    for /f %%i in ('git branch --show-current') do set CURRENT_BRANCH=%%i
    
    git checkout recovery-branch
    git pull origin recovery-branch
    
    if not "%CURRENT_BRANCH%"=="recovery-branch" (
        git checkout %CURRENT_BRANCH%
        git merge recovery-branch
        echo ✅ Branch %CURRENT_BRANCH% sudah diupdate dengan fitur terbaru!
    )
    goto :eof
)

if "%1"=="status" (
    echo 📊 Status Repository:
    for /f %%i in ('git branch --show-current') do echo 📍 Branch saat ini: %%i
    echo 📋 Commit terbaru:
    git log --oneline -3
    echo.
    echo 🌿 Semua branch:
    git branch -a
    goto :eof
)

if "%1"=="help" (
    echo 🚀 Centrova Team Workflow Helper
    echo.
    echo 📋 Commands tersedia:
    echo   start           - Mulai hari kerja (pull update terbaru^)
    echo   new [nama]      - Buat fitur baru
    echo   save [message]  - Simpan progress
    echo   finish [message]- Selesaikan fitur dan merge
    echo   update          - Ambil update dari teman
    echo   status          - Lihat status repository
    echo   help            - Tampilkan bantuan ini
    echo.
    echo 💡 Contoh penggunaan:
    echo   workflow.bat start
    echo   workflow.bat new user-profile
    echo   workflow.bat save "tambah form login"
    echo   workflow.bat update
    echo   workflow.bat finish "selesai user profile system"
    goto :eof
)

echo ❌ Command tidak dikenal: %1
echo 💡 Jalankan: workflow.bat help
