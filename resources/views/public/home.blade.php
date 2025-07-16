<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <img src="/img/logo3.png" alt="Logo" class="h-12 w-auto">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Katalog Produk UMKM</h1>
                <div class="text-sm text-gray-500">Etalase Digital UMKM Binaan PT BPR MSA</div>
            </div>
        </div>
    </x-slot>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-blue-100 py-12 mb-8 border-b">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-8 px-4">
            <div class="flex-1">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-blue-900">Temukan Produk UMKM Terbaik di Sini!</h2>
                <p class="mb-6 text-gray-700 text-lg">Dukung UMKM Indonesia dengan belanja langsung dari pelaku usaha lokal. Temukan produk unggulan, edukasi, dan inspirasi bisnis di satu platform.</p>
                <a href="#katalog" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 font-semibold transition">Jelajahi Katalog</a>
            </div>
            <div class="flex-1 flex justify-center">
                <img src="/img/background.png" alt="UMKM" class="rounded-xl shadow-lg w-full max-w-md object-cover">
            </div>
        </div>
    </section>
    <div class="py-8 bg-gray-50 min-h-screen" id="katalog">
        <div class="max-w-7xl mx-auto px-4">
            <form method="GET" action="" class="mb-6 flex flex-col md:flex-row gap-4 items-center">
                <input type="text" name="q" placeholder="Cari produk..." class="w-full md:w-1/3 px-4 py-2 border rounded focus:outline-none" value="{{ request('q') }}">
                <select name="kategori" class="w-full md:w-1/4 px-4 py-2 border rounded focus:outline-none">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" @selected(request('kategori') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Cari</button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products ?? [] as $product)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        <img src="{{ $product->photo ?? 'https://via.placeholder.com/400x300?text=Foto+Produk' }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">
                        <div class="p-4 flex-1 flex flex-col">
                            <h2 class="font-semibold text-lg mb-1">{{ $product->name }}</h2>
                            <div class="text-blue-600 font-bold mb-2">Rp {{ number_format($product->price,0,',','.') }}</div>
                            <div class="text-gray-500 text-sm mb-2">UMKM: {{ $product->umkm->name ?? '-' }}</div>
                            <a href="{{ route('produk.detail', $product->id) }}" class="mt-auto inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Lihat Detail</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center text-gray-500 py-12">Produk tidak ditemukan.</div>
                @endforelse
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