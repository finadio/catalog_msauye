<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard UMKM
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Selamat datang di Dashboard UMKM</h1>
                <p class="text-gray-700 mb-6">Halo, {{ Auth::user()->name }}!</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Status Produk: Aktif -->
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow rounded">
                        <h3 class="text-lg font-semibold">Produk Aktif</h3>
                        <p class="text-2xl">{{ $produkAktif }}</p>
                    </div>

                    <!-- Status Produk: Pending -->
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 shadow rounded">
                        <h3 class="text-lg font-semibold">Menunggu Persetujuan</h3>
                        <p class="text-2xl">{{ $produkPending }}</p>
                    </div>

                    <!-- Status Produk: Ditolak -->
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow rounded">
                        <h3 class="text-lg font-semibold">Produk Ditolak</h3>
                        <p class="text-2xl">{{ $produkDitolak }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
