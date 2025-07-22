<x-app-layout>
    <div class="py-10 px-6 max-w-7xl mx-auto">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-100 text-green-800 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header & Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-blue-600 text-white p-6 rounded-2xl shadow">
                <div class="text-sm">TOTAL PRODUK</div>
                <div class="text-3xl font-bold mt-2">{{ $products->count() }}</div>
            </div>
            <div class="bg-green-600 text-white p-6 rounded-2xl shadow">
                <div class="text-sm">PRODUK AKTIF</div>
                <div class="text-3xl font-bold mt-2">
                    {{ $products->where('status.name', 'approved')->count() }}
                </div>
            </div>
            <div class="bg-yellow-500 text-white p-6 rounded-2xl shadow">
                <div class="text-sm">MENUNGGU REVIEW</div>
                <div class="text-3xl font-bold mt-2">
                    {{ $products->where('status.name', 'pending')->count() }}
                </div>
            </div>
            <div class="bg-red-600 text-white p-6 rounded-2xl shadow">
                <div class="text-sm">DITOLAK</div>
                <div class="text-3xl font-bold mt-2">
                    {{ $products->where('status.name', 'rejected')->count() }}
                </div>
            </div>
        </div>

        {{-- Judul dan Tombol Tambah --}}
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold">Daftar Produk</h2>
                <p class="text-sm text-gray-500">Kelola dan pantau status produk Anda</p>
            </div>
            <a href="{{ route('umkm_produk.create') }}" class="bg-gradient-to-r from-violet-500 to-indigo-600 text-white px-5 py-2 rounded-xl hover:opacity-90">
                + Tambah Produk Baru
            </a>
        </div>

        {{-- Tabel Produk --}}
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="w-full table-auto text-left">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-4">Nama Produk</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-t">
                            <td class="px-6 py-4 flex items-center gap-3">
                                @if ($product->foto)
                                    <img src="{{ asset('storage/' . $product->foto) }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-blue-400 rounded-lg"></div>
                                @endif
                                <div>
                                    <div class="font-medium">ID: #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-sm text-gray-500">Dibuat: {{ $product->created_at->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($product->status->name) {
                                        'approved' => 'bg-green-100 text-green-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                    {{ strtoupper($product->status->name) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('umkm_produk.edit', $product->id) }}" class="bg-blue-600 text-white px-4 py-1 rounded-lg text-sm">EDIT</a>
                                    <form action="{{ route('umkm_produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 text-white px-4 py-1 rounded-lg text-sm">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-6 text-center text-gray-500">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
