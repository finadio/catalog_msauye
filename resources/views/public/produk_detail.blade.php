<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Detail Produk</h1>
    </x-slot>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-8 flex flex-col md:flex-row gap-8">
            <div class="flex-shrink-0 w-full md:w-1/2">
                <img src="{{ $product->photo ?? 'https://via.placeholder.com/400x300?text=Foto+Produk' }}" alt="{{ $product->name }}" class="rounded-lg w-full object-cover h-72">
            </div>
            <div class="flex-1 flex flex-col">
                <h2 class="text-2xl font-bold mb-2">{{ $product->name }}</h2>
                <div class="text-blue-600 font-bold text-xl mb-2">Rp {{ number_format($product->price,0,',','.') }}</div>
                <div class="mb-4 text-gray-700">{{ $product->description }}</div>
                <div class="mb-2 text-gray-500">UMKM: <a href="{{ route('umkm.detail', $product->umkm->id) }}" class="text-blue-500 hover:underline">{{ $product->umkm->name ?? '-' }}</a></div>
                <div class="mb-4">
                    <div class="text-sm text-gray-600">Kontak Penjual:</div>
                    <div class="flex flex-col gap-1 mt-1">
                        @if($product->umkm->whatsapp)
                            <a href="https://wa.me/{{ $product->umkm->whatsapp }}" target="_blank" class="text-green-600 hover:underline">WhatsApp: {{ $product->umkm->whatsapp }}</a>
                        @endif
                        @if($product->umkm->phone)
                            <span>Telp: {{ $product->umkm->phone }}</span>
                        @endif
                        @if($product->umkm->instagram)
                            <a href="https://instagram.com/{{ $product->umkm->instagram }}" target="_blank" class="text-pink-600 hover:underline">Instagram: @{{ $product->umkm->instagram }}</a>
                        @endif
                    </div>
                </div>
                <a href="https://wa.me/{{ $product->umkm->whatsapp }}" target="_blank" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mt-auto">Hubungi Penjual</a>
            </div>
        </div>
    </div>
</x-app-layout> 