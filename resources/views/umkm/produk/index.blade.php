<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Produk</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('umkm.produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Tambah Produk
                </a>
            </div>

            <div class="bg-white p-4 shadow rounded">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="py-2 text-left">Nama</th>
                            <th class="py-2 text-left">Harga</th>
                            <th class="py-2 text-left">Status</th>
                            <th class="py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-t">
                                <td class="py-2">{{ $product->name }}</td>
                                <td class="py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="py-2">{{ $product->status }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('umkm.produk.edit', $product) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('umkm.produk.destroy', $product) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($products->isEmpty())
                            <tr><td colspan="4" class="py-4 text-center text-gray-500">Belum ada produk</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
