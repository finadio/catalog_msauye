@echo off
cd /d D:\Proyek\catalog_msauye

echo ===============================
echo Pulling latest changes from GitHub...
echo ===============================

git add .
git commit -m "Save local changes before pull"
git pull origin main

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo !!! Gagal melakukan git pull. Periksa apakah ada konflik atau error lainnya.
) else (
    echo.
    echo Done pulling latest updates.
)

pause
