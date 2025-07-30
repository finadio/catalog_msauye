@echo off
cd /d D:\Proyek\catalog_msauye

:: Tampilkan status
echo ===============================
echo Git Status:
echo ===============================
git status
echo.

:: Add semua perubahan
echo Menambahkan semua file yang berubah...
git add .

:: Commit otomatis
set /p pesan="Masukkan pesan commit: "
git commit -m "%pesan%"

:: Push ke GitHub
echo ===============================
echo Push ke GitHub...
echo ===============================
git push origin main

:: Pull untuk update dari GitHub
echo ===============================
echo Tarik perubahan terbaru dari GitHub...
echo ===============================
git pull origin main

echo.
echo ✅ Sync selesai Bro!
pause
