# Team Workflow Guide - Centrova Retail (Tim 2 Orang)

## 🎯 **WORKFLOW MUDAH UNTUK TIM 2 ORANG**

### **Branch Structure**
```
local          ← Production (website live)
    ↓
recovery-branch ← Development utama (gabungan semua fitur)
    ↓
feature/*      ← Branch untuk fitur individual
```

---

## 📋 **DAILY WORKFLOW - STEP BY STEP**

### **🔄 SETIAP PAGI (WAJIB!)**
```bash
# 1. Pastikan di branch utama dan ambil update terbaru
git checkout recovery-branch
git pull origin recovery-branch

# 2. Cek apakah ada update dari teman
git log --oneline -5  # Lihat 5 commit terakhir
```

### **🚀 MULAI FITUR BARU**
```bash
# 1. Buat branch baru dari recovery-branch yang sudah update
git checkout recovery-branch
git pull origin recovery-branch
git checkout -b feature/nama-fitur-baru

# Contoh:
# git checkout -b feature/payment-system
# git checkout -b feature/user-dashboard
```

### **💾 SIMPAN PROGRESS (COMMIT)**
```bash
# Lakukan sesering mungkin (minimal tiap 1-2 jam)
git add .
git commit -m "feat: tambah form login user"
git push origin feature/nama-fitur-baru
```

### **✅ SELESAI FITUR & MAU MERGE**
```bash
# 1. Pastikan fitur sudah selesai dan terupdate
git checkout feature/nama-fitur-baru
git add .
git commit -m "feat: selesai buat payment system"

# 2. Ambil update terbaru dari recovery-branch
git checkout recovery-branch
git pull origin recovery-branch

# 3. Merge fitur ke recovery-branch
git merge feature/nama-fitur-baru

# 4. Push ke remote
git push origin recovery-branch

# 5. Hapus branch fitur (opsional)
git branch -d feature/nama-fitur-baru
```

---

## 🤝 **KOORDINASI TIM**

### **📱 COMMUNICATION PROTOCOL**
**WhatsApp/Telegram Group:**
- 🟢 "Mulai kerjain fitur login system"
- 🟡 "Lagi conflict nih, bantuin dong"
- 🔴 "Fitur payment udah selesai, udah push ke recovery-branch"
- ✅ "Update terbaru udah ready, silakan pull"

### **⏰ JADWAL SYNC**
- **Pagi (09:00):** Pull update terbaru
- **Siang (13:00):** Commit progress + push
- **Sore (17:00):** Merge fitur yang selesai

---

## 🆘 **SKENARIO REAL & SOLUSINYA**

### **Skenario 1: Kamu Bikin Fitur, Teman Push Duluan**
```bash
# Situasi: Teman push fitur invoice, kamu lagi bikin fitur user-profile

# 1. Commit progress kamu dulu
git add .
git commit -m "progress: form user profile 50%"

# 2. Ambil update dari teman
git checkout recovery-branch
git pull origin recovery-branch  # Dapat fitur invoice teman

# 3. Update fitur kamu dengan update terbaru
git checkout feature/user-profile
git rebase recovery-branch  # Atau: git merge recovery-branch

# 4. Lanjut kerjain fitur kamu
# (Fitur invoice teman sudah ada, fitur kamu tetap ada)
```

### **Skenario 2: Kamu Push Duluan, Teman Mau Ambil Update**
```bash
# Yang dilakukan TEMAN:

# 1. Commit progress dulu
git add .
git commit -m "progress: dashboard design"

# 2. Ambil update dari kamu
git checkout recovery-branch
git pull origin recovery-branch  # Dapat fitur kamu

# 3. Update branch fitur dia
git checkout feature/dashboard
git merge recovery-branch  # Sekarang punya fitur kamu + progress dia
```

### **Skenario 3: Conflict Terjadi**
```bash
# Jika ada conflict saat merge:

# 1. Git akan show file yang conflict
git status

# 2. Edit file yang conflict (hapus <<<< ==== >>>>)
# 3. Setelah resolved:
git add .
git commit -m "fix: resolve conflict between feature A and B"

# 4. Lanjut push
git push origin recovery-branch
```

---

## 🛠️ **COMMANDS CHEAT SHEET**

### **Setup Awal (Sekali Doang)**
```bash
git clone https://github.com/tanbopp/centrova-retail.git
cd centrova-retail
git checkout recovery-branch
```

### **Daily Commands (Setiap Hari)**
```bash
# Pagi: Ambil update
git checkout recovery-branch && git pull origin recovery-branch

# Mulai fitur: 
git checkout -b feature/nama-fitur

# Simpan progress:
git add . && git commit -m "progress: ..." && git push origin feature/nama-fitur

# Selesai fitur:
git checkout recovery-branch && git pull origin recovery-branch
git merge feature/nama-fitur && git push origin recovery-branch
```

### **Emergency Commands**
```bash
# Lihat siapa yang commit apa:
git log --oneline --graph -10

# Lihat perubahan file:
git diff filename.php

# Rollback ke commit sebelumnya:
git checkout commit-hash filename.php

# Cari commit yang hilang:
git reflog
```

---

## � **CONTOH WORKFLOW REAL**

### **Hari Senin:**
- **09:00** Kamu: Pull update → Mulai `feature/user-auth`
- **11:00** Teman: Pull update → Mulai `feature/product-catalog`
- **15:00** Kamu: Selesai auth → Merge ke `recovery-branch`
- **16:00** Teman: Pull update (dapat fitur auth) → Lanjut catalog

### **Hari Selasa:**
- **09:00** Teman: Selesai catalog → Merge ke `recovery-branch`
- **10:00** Kamu: Pull update (dapat fitur catalog) → Mulai `feature/shopping-cart`
- **14:00** Kamu: Progress cart 70% → Commit & push
- **15:00** Teman: Mulai `feature/admin-panel` (sudah punya auth + catalog + progress cart)

---

## 🎯 **GOLDEN RULES (WAJIB!)**

### ✅ **DO (LAKUKAN):**
1. **SELALU** pull sebelum mulai kerja
2. **COMMIT SERING** (minimal tiap 1-2 jam)
3. **KOMUNIKASI** di WhatsApp sebelum merge
4. **TEST** fitur sebelum push ke recovery-branch
5. **BACKUP** dengan push branch fitur

### ❌ **DON'T (JANGAN):**
1. **JANGAN** langsung push ke `local` (production)
2. **JANGAN** merge kalau belum pull update terbaru
3. **JANGAN** commit kalau ada error
4. **JANGAN** force push (`git push -f`)
5. **JANGAN** hapus branch orang lain

---

## � **TOOLS YANG MEMBANTU**

### **Git GUI (Recommended):**
- **GitKraken** - Visual yang bagus untuk lihat branch
- **VS Code Git** - Built-in di VS Code
- **GitHub Desktop** - Simple untuk pemula

### **Communication:**
- **WhatsApp Group** - Quick updates
- **Trello Board** - Task management
- **Google Drive** - Share assets/designs

---

## � **TROUBLESHOOTING**

### **"Fatal: Not a git repository"**
```bash
cd /path/to/centrova-retail
git status
```

### **"Your branch is behind"**
```bash
git pull origin recovery-branch
```

### **"Merge conflict"**
```bash
# Edit file yang conflict, hapus markers
git add .
git commit -m "fix: resolve conflict"
```

### **"Permission denied"**
```bash
# Setup SSH key atau gunakan HTTPS
git remote set-url origin https://github.com/tanbopp/centrova-retail.git
```

---

## � **COMMIT MESSAGE TEMPLATE**

```bash
# Format: type: description
feat: add user login functionality
fix: resolve payment gateway issue
style: update button design
docs: add API documentation
refactor: optimize database queries
test: add unit tests for auth
```

**Ingat: Workflow ini memastikan kalian berdua bisa kerja parallel tanpa saling menghilangkan fitur! 🚀**
