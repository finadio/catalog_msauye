<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <img src="/img/logo3.png" alt="Logo" class="h-10 w-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Admin
            </h2>
        </div>
    </x-slot>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-100 via-blue-50 to-white py-10 border-b mb-8">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8 px-4">
            <div class="flex-1">
                <h3 class="text-3xl md:text-4xl font-bold mb-2 text-blue-900">Selamat Datang di Dashboard Admin PT BPR MSA</h3>
                <p class="mb-4 text-gray-700 text-lg">Pantau data UMKM, produk, kategori, artikel, dan kelola platform katalog UMKM dengan mudah dan profesional.</p>
                <a href="/" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 font-semibold transition">Lihat Katalog Publik</a>
            </div>
            <div class="flex-1 flex justify-center">
                <img src="/img/background.png" alt="Dashboard" class="rounded-xl shadow-lg w-full max-w-xs object-cover">
            </div>
        </div>
    </section>
    <!-- Statistik Card -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-4 -mt-12 z-10 relative">
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center border-t-4 border-blue-600">
            <div class="bg-blue-100 p-3 rounded-full mb-2">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4"/></svg>
            </div>
            <div class="text-2xl font-bold text-blue-900">{{ $umkmCount ?? '-' }}</div>
            <div class="text-gray-500">UMKM</div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center border-t-4 border-green-600">
            <div class="bg-green-100 p-3 rounded-full mb-2">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-3-3.87M4 21v-2a4 4 0 013-3.87m9-7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div class="text-2xl font-bold text-green-900">{{ $productCount ?? '-' }}</div>
            <div class="text-gray-500">Produk</div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center border-t-4 border-yellow-500">
            <div class="bg-yellow-100 p-3 rounded-full mb-2">
                <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v9m12 4h-4m4 0a2 2 0 01-2 2h-4a2 2 0 01-2-2m4 0V3"/></svg>
            </div>
            <div class="text-2xl font-bold text-yellow-700">{{ $categoryCount ?? '-' }}</div>
            <div class="text-gray-500">Kategori</div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center border-t-4 border-purple-600">
            <div class="bg-purple-100 p-3 rounded-full mb-2">
                <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
            </div>
            <div class="text-2xl font-bold text-purple-900">{{ $articleCount ?? '-' }}</div>
            <div class="text-gray-500">Artikel</div>
        </div>
    </div>
    <!-- Info Section -->
    <div class="max-w-6xl mx-auto mt-12 px-4">
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1">
                <h4 class="text-xl font-bold mb-2 text-blue-900">Tentang Platform</h4>
                <p class="text-gray-700 mb-2">MSA Katalog UMKM adalah platform digital untuk mendukung pertumbuhan UMKM Indonesia. Admin dapat memantau data, mengelola produk, kategori, artikel, dan membantu UMKM berkembang.</p>
                <a href="/tentang" class="inline-block mt-4 px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold transition">Tentang Kami</a>
            </div>
            <div class="flex-1 flex justify-center">
                <img src="/img/logo3.png" alt="Logo" class="h-32 w-auto">
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-white border-t mt-12 py-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 px-4">
            <div class="flex items-center gap-2">
                <img src="/img/logo3.png" alt="Logo" class="h-8 w-auto">
                <span class="font-bold text-blue-900">PT BPR MSA</span>
            </div>
            <div class="text-gray-500 text-sm">&copy; {{ date('Y') }} PT BPR MSA. All rights reserved.</div>
        </div>
    </footer>
</x-app-layout> 