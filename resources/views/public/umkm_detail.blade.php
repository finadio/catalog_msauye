<x-app-layout>
<<<<<<< Updated upstream
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row gap-8 md:gap-12">
            <div class="flex-shrink-0 w-full md:w-1/3 rounded-lg overflow-hidden shadow-md">
                {{-- PERBAIKAN: Ubah 'umkm-default.jpg' menjadi 'umkm-default.png' --}}
                <img src="{{ $umkm->photo ? asset('storage/'.$umkm->photo) : asset('img/umkm-default.png') }}" alt="{{ $umkm->name }}" class="w-full h-56 md:h-72 object-cover">
            </div>
            <div class="flex-1 flex flex-col">
                <h2 class="text-3xl font-bold mb-3 text-gray-900">{{ $umkm->name }}</h2>
                <p class="mb-6 text-gray-700 leading-relaxed">{{ $umkm->description }}</p>
                <div class="mb-4 text-gray-600 text-sm">
                    <span class="font-semibold">Alamat:</span> {{ $umkm->address }}
=======
    {{-- Hero Section --}}
    <div class="relative bg-[#0B1120] pt-40 pb-32 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl"></div>
            <div class="absolute top-1/2 -left-24 w-72 h-72 rounded-full bg-purple-500/10 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <div class="flex flex-col md:flex-row items-center md:items-end gap-8">
                {{-- Profile Image --}}
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-2xl overflow-hidden border-4 border-white/10 shadow-2xl flex-shrink-0 bg-white">
                    <img src="{{ $umkm->photo ? asset('storage/'.$umkm->photo) : asset('img/umkm-default.png') }}" 
                         alt="{{ $umkm->name }}" 
                         class="w-full h-full object-cover">
>>>>>>> Stashed changes
                </div>
                
                {{-- Info --}}
                <div class="flex-1 text-center md:text-left mb-2 md:mb-0">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-3">
                        <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-medium border border-blue-500/20">
                            Mitra UMKM
                        </span>
                        <span class="px-3 py-1 rounded-full bg-purple-500/20 text-purple-400 text-xs font-medium border border-purple-500/20">
                            Terverifikasi
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $umkm->name }}</h1>
                    <p class="text-gray-400 flex items-center justify-center md:justify-start gap-2">
                        <i class='bx bx-map text-lg'></i>
                        {{ Str::limit($umkm->address, 60) }}
                    </p>
                </div>

                {{-- Action --}}
                <div class="flex gap-3">
                    @if($umkm->whatsapp)
                        <a href="https://wa.me/{{ $umkm->whatsapp }}" target="_blank" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-green-500/20 flex items-center gap-2">
                            <i class='bx bxl-whatsapp text-xl'></i>
                            <span>Chat</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="bg-gray-50 min-h-screen pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Left Sidebar (Info) --}}
                <div class="lg:col-span-1 space-y-6">
                    {{-- Contact Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class='bx bx-id-card text-blue-500'></i>
                            Informasi Kontak
                        </h3>
                        <div class="space-y-4">
                            @if($umkm->phone)
                                <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 hover:bg-blue-50 transition-colors group">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center shadow-sm text-blue-500 group-hover:text-blue-600">
                                        <i class='bx bx-phone text-xl'></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">Telepon</p>
                                        <a href="tel:{{ $umkm->phone }}" class="text-gray-900 font-semibold hover:text-blue-600 transition-colors">{{ $umkm->phone }}</a>
                                    </div>
                                </div>
                            @endif

                            @if($umkm->whatsapp)
                                <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 hover:bg-green-50 transition-colors group">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center shadow-sm text-green-500 group-hover:text-green-600">
                                        <i class='bx bxl-whatsapp text-xl'></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">WhatsApp</p>
                                        <a href="https://wa.me/{{ $umkm->whatsapp }}" target="_blank" class="text-gray-900 font-semibold hover:text-green-600 transition-colors">{{ $umkm->whatsapp }}</a>
                                    </div>
                                </div>
                            @endif

                            @if($umkm->instagram)
                                <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 hover:bg-pink-50 transition-colors group">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center shadow-sm text-pink-500 group-hover:text-pink-600">
                                        <i class='bx bxl-instagram text-xl'></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">Instagram</p>
                                        <a href="https://instagram.com/{{ $umkm->instagram }}" target="_blank" class="text-gray-900 font-semibold hover:text-pink-600 transition-colors">{{ '@'.$umkm->instagram }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Address Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class='bx bx-map-pin text-red-500'></i>
                            Lokasi
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            {{ $umkm->address }}
                        </p>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- About Section --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tentang UMKM</h3>
                        <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
                            {{ $umkm->description }}
                        </div>
                    </div>

                    {{-- Products Section --}}
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Produk Unggulan</h3>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                {{ count($umkm->products ?? []) }} Produk
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @forelse($umkm->products ?? [] as $product)
                                <div class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                                    <div class="relative aspect-square overflow-hidden bg-gray-100">
                                        <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <a href="{{ route('produk.detail', $product->id) }}" class="px-4 py-2 bg-white text-gray-900 rounded-lg font-semibold text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="p-4 flex-1 flex flex-col">
                                        <div class="mb-2">
                                            <span class="text-xs text-blue-600 font-medium bg-blue-50 px-2 py-1 rounded-md">
                                                {{ $product->category->name ?? 'Umum' }}
                                            </span>
                                        </div>
                                        <h4 class="font-bold text-gray-900 mb-1 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                            {{ $product->name }}
                                        </h4>
                                        <p class="text-gray-500 text-sm font-medium mt-auto">
                                            Rp {{ number_format($product->price,0,',','.') }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-gray-300">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class='bx bx-package text-3xl text-gray-400'></i>
                                    </div>
                                    <p class="text-gray-500">Belum ada produk yang ditambahkan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>