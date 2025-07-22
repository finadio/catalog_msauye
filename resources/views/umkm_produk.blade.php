<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h2 class="text-3xl font-bold text-gray-800">Daftar Produk UMKM</h2>
                <a href="{{ route('umkm_produkcreate', auth()->id()) }}" class="inline-block px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl shadow hover:bg-blue-700 transition duration-300">
                    + Tambah Produk Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->isEmpty())
                <div class="text-gray-500 text-center py-12 text-lg">Belum ada produk untuk UMKM ini.</div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $item)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $item->nama }}</h3>
                                <p class="text-gray-600 text-sm mb-1">Harga: <span class="font-medium text-blue-700">Rp {{ number_format($item->harga, 0, ',', '.') }}</span></p>
                                <p class="text-gray-600 text-sm mb-4">Deskripsi: {{ Str::limit($item->deskripsi, 100) }}</p>
                                <div class="flex justify-start gap-3">
                                    <a href="{{ route('umkm_produkedit', [$umkm->id, $item->id]) }}" class="px-4 py-1.5 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.produk.destroy', [$umkm->id, $item->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-1.5 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
