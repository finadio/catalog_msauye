<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Profil UMKM</h1>
    </x-slot>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-8 flex flex-col md:flex-row gap-8">
            <div class="flex-shrink-0 w-full md:w-1/3">
                <img src="{{ $umkm->photo ?? 'https://via.placeholder.com/300x300?text=Foto+UMKM' }}" alt="{{ $umkm->name }}" class="rounded-lg w-full object-cover h-56">
            </div>
            <div class="flex-1 flex flex-col">
                <h2 class="text-2xl font-bold mb-2">{{ $umkm->name }}</h2>
                <div class="mb-2 text-gray-700">{{ $umkm->description }}</div>
                <div class="mb-2 text-gray-500">Alamat: {{ $umkm->address }}</div>
                <div class="mb-4">
                    <div class="text-sm text-gray-600">Kontak:</div>
                    <div class="flex flex-col gap-1 mt-1">
                        @if($umkm->whatsapp)
                            <a href="https://wa.me/{{ $umkm->whatsapp }}" target="_blank" class="text-green-600 hover:underline">WhatsApp: {{ $umkm->whatsapp }}</a>
                        @endif
                        @if($umkm->phone)
                            <span>Telp: {{ $umkm->phone }}</span>
                        @endif
                        @if($umkm->instagram)
                            <a href="https://instagram.com/{{ $umkm->instagram }}" target="_blank" class="text-pink-600 hover:underline">Instagram: @{{ $umkm->instagram }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-4xl mx-auto mt-8">
            <h3 class="text-lg font-semibold mb-4">Produk dari UMKM ini</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($umkm->products ?? [] as $product)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        <img src="{{ $product->photo ?? 'https://via.placeholder.com/400x300?text=Foto+Produk' }}" alt="{{ $product->name }}" class="h-40 w-full object-cover">
                        <div class="p-4 flex-1 flex flex-col">
                            <h4 class="font-semibold text-md mb-1">{{ $product->name }}</h4>
                            <div class="text-blue-600 font-bold mb-2">Rp {{ number_format($product->price,0,',','.') }}</div>
                            <a href="{{ route('produk.detail', $product->id) }}" class="mt-auto inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Lihat Detail</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-8">Belum ada produk.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 