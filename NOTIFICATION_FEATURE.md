# 🔔 Fitur Notifikasi Baru

Saya telah menambahkan sistem notifikasi yang lengkap dan profesional ke dalam admin panel Anda.

## 1. Ikon Lonceng (Bell Icon)
Sekarang terdapat ikon lonceng di bagian atas dashboard (dekat profil user).
- **Real-time**: Ikon ini akan menampilkan badge merah jika ada notifikasi baru.
- **Dropdown**: Klik ikon untuk melihat daftar notifikasi terkini secara cepat tanpa meninggalkan halaman.
- **Polling**: Sistem akan mengecek notifikasi baru setiap 30 detik secara otomatis.

## 2. Widget Notifikasi di Dashboard
Saya menambahkan widget **"Notifikasi Terbaru"** di halaman utama dashboard.
- Menampilkan 5 notifikasi terakhir.
- Status "Belum Dibaca" ditandai dengan ikon lonceng kuning.
- Status "Sudah Dibaca" ditandai dengan ikon centang hijau.
- Tombol aksi cepat untuk menandai notifikasi sebagai sudah dibaca.

## 3. Halaman Manajemen Notifikasi (Admin Feature)
Menu **"Sistem > Notifikasi"** sekarang lebih powerful:
- **Filter Canggih**: Bisa filter berdasarkan status (Read/Unread) dan tipe notifikasi.
- **Bulk Actions**: Bisa menandai banyak notifikasi sekaligus sebagai "Sudah Dibaca".
- **Auto-Read**: Saat melihat detail notifikasi, statusnya otomatis berubah menjadi "Sudah Dibaca".
- **Visual Indicators**: Warna dan ikon yang jelas untuk membedakan tipe notifikasi (Success, Warning, Info, Danger).

## Cara Menguji
1. Refresh halaman admin.
2. Anda akan melihat ikon lonceng di pojok kanan atas.
3. Di dashboard, scroll ke bawah untuk melihat widget "Notifikasi Terbaru".
4. Coba kirim notifikasi test (jika ada fitur trigger) atau tunggu aktivitas sistem yang memicu notifikasi.
