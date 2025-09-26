#!/bin/bash

# Centrova Team Workflow Helper Scripts
# Simpan sebagai workflow.sh dan jalankan: bash workflow.sh [command]

case "$1" in
    "start")
        echo "🚀 Memulai hari kerja..."
        git checkout recovery-branch
        git pull origin recovery-branch
        echo "✅ Branch recovery-branch sudah update!"
        echo "📋 Commit terbaru:"
        git log --oneline -5
        ;;
    
    "new")
        if [ -z "$2" ]; then
            echo "❌ Error: Nama fitur harus diisi!"
            echo "💡 Contoh: bash workflow.sh new payment-system"
            exit 1
        fi
        echo "🔧 Membuat fitur baru: $2"
        git checkout recovery-branch
        git pull origin recovery-branch
        git checkout -b "feature/$2"
        echo "✅ Branch feature/$2 siap digunakan!"
        ;;
    
    "save")
        if [ -z "$2" ]; then
            echo "❌ Error: Commit message harus diisi!"
            echo "💡 Contoh: bash workflow.sh save 'tambah form login'"
            exit 1
        fi
        echo "💾 Menyimpan progress..."
        git add .
        git commit -m "progress: $2"
        CURRENT_BRANCH=$(git branch --show-current)
        git push origin "$CURRENT_BRANCH"
        echo "✅ Progress tersimpan di branch $CURRENT_BRANCH!"
        ;;
    
    "finish")
        if [ -z "$2" ]; then
            echo "❌ Error: Commit message harus diisi!"
            echo "💡 Contoh: bash workflow.sh finish 'selesai payment system'"
            exit 1
        fi
        echo "🏁 Menyelesaikan fitur..."
        CURRENT_BRANCH=$(git branch --show-current)
        
        # Commit perubahan terakhir
        git add .
        git commit -m "feat: $2"
        
        # Pindah ke recovery-branch dan update
        git checkout recovery-branch
        git pull origin recovery-branch
        
        # Merge fitur
        git merge "$CURRENT_BRANCH"
        git push origin recovery-branch
        
        echo "✅ Fitur berhasil di-merge ke recovery-branch!"
        echo "🗑️  Hapus branch fitur? (y/n)"
        read -r response
        if [[ "$response" == "y" || "$response" == "Y" ]]; then
            git branch -d "$CURRENT_BRANCH"
            echo "🗑️  Branch $CURRENT_BRANCH dihapus"
        fi
        ;;
    
    "update")
        echo "🔄 Mengambil update dari teman..."
        CURRENT_BRANCH=$(git branch --show-current)
        
        # Commit progress dulu jika ada perubahan
        if ! git diff-index --quiet HEAD --; then
            echo "💾 Menyimpan progress sementara..."
            git add .
            git commit -m "progress: temporary save before update"
        fi
        
        # Ambil update
        git checkout recovery-branch
        git pull origin recovery-branch
        
        # Kembali ke branch fitur dan merge update
        if [[ "$CURRENT_BRANCH" != "recovery-branch" ]]; then
            git checkout "$CURRENT_BRANCH"
            git merge recovery-branch
            echo "✅ Branch $CURRENT_BRANCH sudah diupdate dengan fitur terbaru!"
        fi
        ;;
    
    "status")
        echo "📊 Status Repository:"
        echo "📍 Branch saat ini: $(git branch --show-current)"
        echo "📋 Commit terbaru:"
        git log --oneline -3
        echo ""
        echo "🌿 Semua branch:"
        git branch -a
        ;;
    
    "help")
        echo "🚀 Centrova Team Workflow Helper"
        echo ""
        echo "📋 Commands tersedia:"
        echo "  start           - Mulai hari kerja (pull update terbaru)"
        echo "  new [nama]      - Buat fitur baru"
        echo "  save [message]  - Simpan progress"
        echo "  finish [message]- Selesaikan fitur dan merge"
        echo "  update          - Ambil update dari teman"
        echo "  status          - Lihat status repository"
        echo "  help            - Tampilkan bantuan ini"
        echo ""
        echo "💡 Contoh penggunaan:"
        echo "  bash workflow.sh start"
        echo "  bash workflow.sh new user-profile"
        echo "  bash workflow.sh save 'tambah form login'"
        echo "  bash workflow.sh update"
        echo "  bash workflow.sh finish 'selesai user profile system'"
        ;;
    
    *)
        echo "❌ Command tidak dikenal: $1"
        echo "💡 Jalankan: bash workflow.sh help"
        ;;
esac
