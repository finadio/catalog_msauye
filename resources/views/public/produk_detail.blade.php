<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Detail Produk</h1>
    </x-slot>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-2xl p-8 md:p-12 flex flex-col lg:flex-row gap-8 lg:gap-16">
            <div class="flex-shrink-0 w-full lg:w-1/2 rounded-xl overflow-hidden shadow-xl group">
                <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-72 md:h-96 object-cover transform transition-transform duration-300 group-hover:scale-105">
            </div>
            <div class="flex-1 flex flex-col justify-between pt-4 lg:pt-0">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">{{ $product->name }}</h2>
                    <div class="text-blue-700 font-extrabold text-3xl lg:text-4xl mb-6">Rp {{ number_format($product->price,0,',','.') }}</div>
                    
                    <p class="mb-8 text-gray-700 leading-relaxed text-base lg:text-lg">{{ $product->description }}</p>
                    
                    <div class="mb-4 text-gray-600 text-sm lg:text-base">
                        <span class="font-semibold">Kategori:</span> <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">{{ $product->category->name ?? '-' }}</span>
                    </div>
                    <div class="mb-8 text-gray-600 text-sm lg:text-base">
                        <span class="font-semibold">Status Produk:</span>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                            @if($product->status->name == 'approved') bg-green-100 text-green-800
                            @elseif($product->status->name == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($product->status->name) }}
                        </span>
                    </div>
                </div>
                
                <div>
                    <div class="mb-4 text-gray-800 text-lg lg:text-xl font-bold">
                        UMKM: <a href="{{ route('umkm.detail', $product->umkm->id) }}" class="text-blue-600 hover:underline transition-colors duration-200">{{ $product->umkm->name ?? '-' }}</a>
                    </div>
                    <div class="mb-6">
                        <p class="text-gray-700 font-semibold text-base mb-3">Kontak Penjual:</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @if($product->umkm->whatsapp)
                                <a href="https://wa.me/{{ $product->umkm->whatsapp }}" target="_blank" 
                                   class="flex items-center p-3 bg-green-50 text-green-800 rounded-lg hover:bg-green-100 font-medium transition-colors duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <i class='bx bxl-whatsapp text-2xl mr-3'></i> WhatsApp: {{ $product->umkm->whatsapp }}
                                </a>
                            @endif
                            @if($product->umkm->phone)
                                <a href="tel:{{ $product->umkm->phone }}" 
                                   class="flex items-center p-3 bg-blue-50 text-blue-800 rounded-lg hover:bg-blue-100 font-medium transition-colors duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <i class='bx bx-phone text-2xl mr-3'></i> Telepon: {{ $product->umkm->phone }}
                                </a>
                            @endif
                            @if($product->umkm->instagram)
                                <a href="https://instagram.com/{{ $product->umkm->instagram }}" target="_blank" 
                                   class="flex items-center p-3 bg-pink-50 text-pink-800 rounded-lg hover:bg-pink-100 font-medium transition-colors duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <i class='bx bxl-instagram text-2xl mr-3'></i> Instagram: @{{ $product->umkm->instagram }}
                                </a>
                            @endif
                            @if($product->umkm->tiktok)
                                <a href="https://tiktok.com/@{{ $product->umkm->tiktok }}" target="_blank" 
                                   class="flex items-center p-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium transition-colors duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <i class='bx bxl-tiktok text-2xl mr-3'></i> TikTok: @{{ $product->umkm->tiktok }}
                                </a>
                            @endif
                            @if($product->umkm->website)
                                <a href="{{ $product->umkm->website }}" target="_blank" 
                                   class="flex items-center p-3 bg-purple-50 text-purple-800 rounded-lg hover:bg-purple-100 font-medium transition-colors duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <i class='bx bx-globe text-2xl mr-3'></i> Website: Kunjungi Situs
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>