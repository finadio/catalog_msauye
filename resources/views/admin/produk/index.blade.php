<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Produk</h2>
    </x-slot>
    <div class="py-8 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <form method="GET" class="mb-4 flex flex-wrap gap-2 items-center">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..." class="px-4 py-2 border rounded w-64">
            <select name="kategori" class="px-4 py-2 border rounded">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('kategori') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="status" class="px-4 py-2 border rounded">
                <option value="">Semua Status</option>
                @foreach($statuses as $stat)
                    <option value="{{ $stat->id }}" @selected(request('status') == $stat->id)>{{ $stat->name }}</option>
                @endforeach
            </select>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
        </form>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">UMKM</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($product->price,0,',','.') }}</td>
                            <td class="px-4 py-2">{{ $product->status->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $product->umkm->name ?? '-' }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                @if($product->status->name == 'pending')
                                    <form action="{{ route('admin.produk.approve', $product->id) }}" method="POST" onsubmit="return confirm('Approve produk ini?')">
                                        @csrf
                                        <button class="px-2 py-1 bg-green-600 text-white rounded">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.produk.reject', $product->id) }}" method="POST" onsubmit="return confirm('Reject produk ini?')">
                                        @csrf
                                        <button class="px-2 py-1 bg-red-600 text-white rounded">Reject</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.produk.edit', $product->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus produk?')">
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