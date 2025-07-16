<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Produk Saya</h2>
    </x-slot>
    <div class="py-8 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <div class="mb-4">
            <a href="{{ route('umkm.produk.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Produk</a>
        </div>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Foto</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="px-4 py-2"><img src="{{ $product->photo ? asset('storage/'.$product->photo) : 'https://via.placeholder.com/80x60?text=Foto' }}" class="h-12 w-16 object-cover rounded"/></td>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($product->price,0,',','.') }}</td>
                            <td class="px-4 py-2">{{ $product->status->name ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('umkm.produk.edit', $product->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('umkm.produk.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus produk?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-gray-500 py-8">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-app-layout> 