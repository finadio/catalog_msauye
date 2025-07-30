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

@REM :: Pull untuk update dari GitHub
@REM echo ===============================
@REM echo Tarik perubahan terbaru dari GitHub...
@REM echo ===============================
@REM git pull origin main

echo.
echo ✅ Sync selesai Bro!
pause
