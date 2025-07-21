import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Integrasi AJAX produk: kode utama AJAX search/filter produk ada di produk_index.blade.php via @push('scripts')
// Jika ingin menambah interaksi global, tambahkan di sini.
