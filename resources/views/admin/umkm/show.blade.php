<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail UMKM</h2>
    </x-slot>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-8 flex flex-col md:flex-row gap-8">
            <div class="flex-shrink-0 w-full md:w-1/3">
                <img src="{{ $umkm->photo ? asset('storage/'.$umkm->photo) : 'https://via.placeholder.com/300x300?text=Foto+UMKM' }}" alt="{{ $umkm->name }}" class="rounded-lg w-full object-cover h-56">
            </div>
            <div class="flex-1 flex flex-col">
                <h2 class="text-2xl font-bold mb-2">{{ $umkm->name }}</h2>
                <div class="mb-2 text-gray-700">{{ $umkm->description }}</div>
                <div class="mb-2 text-gray-500">Alamat: {{ $umkm->address }}</div>
                <div class="mb-2 text-gray-500">Telepon: {{ $umkm->phone }}</div>
                <div class="mb-2 text-gray-500">WhatsApp: {{ $umkm->whatsapp }}</div>
                <div class="mb-2 text-gray-500">Instagram: {{ $umkm->instagram }}</div>
            </div>
        </div>
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Produk UMKM</h3>
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Kategori</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($umkm->products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($product->price,0,',','.') }}</td>
                                <td class="px-4 py-2">{{ $product->status->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-gray-500 py-8">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 