<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Profil UMKM</h1>
    </x-slot>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row gap-8 md:gap-12">
            <div class="flex-shrink-0 w-full md:w-1/3 rounded-lg overflow-hidden shadow-md">
                <img src="{{ $umkm->photo ? asset('storage/'.$umkm->photo) : asset('img/umkm-default.jpg') }}" alt="{{ $umkm->name }}" class="w-full h-56 md:h-72 object-cover">
            </div>
            <div class="flex-1 flex flex-col">
                <h2 class="text-3xl font-bold mb-3 text-gray-900">{{ $umkm->name }}</h2>
                <p class="mb-6 text-gray-700 leading-relaxed">{{ $umkm->description }}</p>
                <div class="mb-4 text-gray-600 text-sm">
                    <span class="font-semibold">Alamat:</span> {{ $umkm->address }}
                </div>
                <div class="mb-6">
                    <div class="text-sm text-gray-600 font-semibold mb-2">Kontak UMKM:</div>
                    <div class="flex flex-col gap-2">
                        @if($umkm->whatsapp)
                            <a href="https://wa.me/{{ $umkm->whatsapp }}" target="_blank" class="flex items-center text-green-600 hover:text-green-700 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.34 4.96l-1.4 5.14 5.25-1.37c1.45.79 3.08 1.25 4.78 1.25 5.46 0 9.91-4.45 9.91-9.91s-4.45-9.91-9.91-9.91zm.04 18.12c-1.54 0-3-.42-4.28-1.18l-.3-.18-3.14.82.84-3.04-.2-.32c-.82-1.3-1.26-2.8-1.26-4.38 0-4.52 3.67-8.19 8.19-8.19s8.19 3.67 8.19 8.19c0 4.52-3.67 8.19-8.19 8.19zm4.52-6.16c-.25-.12-.92-.45-1.06-.5c-.14-.05-.24-.07-.34.07-.09.14-.36.45-.44.54-.08.09-.16.1-.29.05-.14-.05-.59-.22-.75-.46-.15-.23-.08-.34.07-.46.13-.12.29-.3.39-.45.09-.14.05-.24-.02-.34-.07-.09-.64-1.54-.88-2.1c-.24-.56-.48-.48-.65-.49-.17-.01-.37-.01-.57-.01-.2 0-.52.07-.79.34-.26.26-1.02.99-1.02 2.42s1.05 2.81 1.2 3.01c.15.2.99 1.51 2.4 2.14 1.41.63 1.77.56 2.61.5c.84-.06 2.59-1.06 2.95-2.09.36-1.03.36-.95.25-1.18z"/></svg>
                                WhatsApp: {{ $umkm->whatsapp }}
                            </a>
                        @endif
                        @if($umkm->phone)
                            <a href="tel:{{ $umkm->phone }}" class="flex items-center text-blue-600 hover:text-blue-700 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.83 21 3 13.17 3 5c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1v3.5c0 .35-.09.7-.24 1.02l-2.2 2.2z"/></svg>
                                Telp: {{ $umkm->phone }}
                            </a>
                        @endif
                        @if($umkm->instagram)
                            <a href="https://instagram.com/{{ $umkm->instagram }}" target="_blank" class="flex items-center text-pink-600 hover:text-pink-700 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M7.8 2c-2.6 0-4.8 2.2-4.8 4.8v10.4c0 2.6 2.2 4.8 4.8 4.8h10.4c2.6 0 4.8-2.2 4.8-4.8V7.8c0-2.6-2.2-4.8-4.8-4.8H7.8zm0 2.4h10.4c1.3 0 2.4 1.1 2.4 2.4v10.4c0 1.3-1.1 2.4-2.4 2.4H7.8c-1.3 0-2.4-1.1-2.4-2.4V7.8c0-1.3 1.1-2.4 2.4-2.4zM12 9.6c-2.4 0-4.4 2-4.4 4.4s2 4.4 4.4 4.4 4.4-2 4.4-4.4-2-4.4-4.4-4.4zm0 2.4c1.1 0 2 1 2 2s-.9 2-2 2-2-1-2-2 .9-2 2-2zm5.2-6.8c.7 0 1.2.5 1.2 1.2s-.5 1.2-1.2 1.2-1.2-.5-1.2-1.2.5-1.2 1.2-1.2z"/></svg>
                                Instagram: @{{ $umkm->instagram }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-5xl mx-auto mt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Produk dari UMKM ini</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-6">
                @forelse($umkm->products ?? [] as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col group">
                        <div class="relative overflow-hidden w-full aspect-square">
                            <img src="{{ $product->photo ? asset('storage/'.$product->photo) : asset('img/produk-dummy-1.jpg') }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105">
                            @if($product->status->name != 'approved')
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-md z-10">
                                    {{ ucfirst($product->status->name) }}
                                </span>
                            @endif
                        </div>
                        <div class="p-3 flex-1 flex flex-col">
                            <h4 class="font-semibold text-sm mb-1 text-gray-800 leading-tight truncate">{{ $product->name }}</h4>
                            <div class="text-blue-600 font-bold text-base mb-2">Rp {{ number_format($product->price,0,',','.') }}</div>
                            <div class="text-gray-500 text-xs mb-3 truncate">Kategori: {{ $product->category->name ?? '-' }}</div>
                            <a href="{{ route('produk.detail', $product->id) }}" class="mt-auto block text-center px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-semibold text-sm transition duration-300">Detail</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-8 text-lg">Belum ada produk dari UMKM ini.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>