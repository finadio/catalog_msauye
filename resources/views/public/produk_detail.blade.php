<x-app-layout>
<<<<<<< Updated upstream
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-2xl p-8 md:p-12 flex flex-col lg:flex-row gap-8 lg:gap-16">
            {{-- Modified Image Section --}}
            <div class="flex-shrink-0 w-full lg:w-1/2 rounded-xl overflow-hidden shadow-xl group"> {{-- Reverted to lg:w-1/2 for a "boxed" appearance on large screens --}}
                <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-auto object-cover transform transition-transform duration-300 group-hover:scale-105"> {{-- Changed to h-auto to ensure the full image is shown without fixed height constraints --}}
            </div>
            {{-- End Modified Image Section --}}
=======
    <div class="bg-gray-50 min-h-screen pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Breadcrumb --}}
            <nav class="flex mb-8 text-sm font-medium text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('produk.index') }}" class="hover:text-blue-600 transition-colors">Produk</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ Str::limit($product->name, 30) }}</span>
            </nav>
>>>>>>> Stashed changes

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="flex flex-col lg:flex-row">
                    
                    {{-- Image Section --}}
                    <div class="lg:w-1/2 bg-gray-100 relative group">
                        <div class="aspect-square lg:aspect-auto lg:h-full relative overflow-hidden">
                            <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105">
                            
                            @if($product->status->name != 'approved')
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                        @if($product->status->name == 'pending') bg-yellow-400 text-yellow-900
                                        @else bg-red-500 text-white @endif">
                                        {{ ucfirst($product->status->name) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Details Section --}}
                    <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col">
                        <div class="mb-auto">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wider">
                                    {{ $product->category->name ?? 'Umum' }}
                                </span>
                            </div>

                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                                {{ $product->name }}
                            </h1>

                            <div class="flex items-baseline gap-2 mb-8">
                                <span class="text-3xl lg:text-4xl font-bold text-blue-600">
                                    Rp {{ number_format($product->price,0,',','.') }}
                                </span>
                            </div>

                            <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Produk</h3>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>

                        {{-- Seller Info & Actions --}}
                        <div class="border-t border-gray-100 pt-8 mt-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                    @if($product->umkm->photo)
                                        <img src="{{ asset('storage/'.$product->umkm->photo) }}" alt="{{ $product->umkm->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class='bx bx-store text-2xl text-gray-400'></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Dijual oleh</p>
                                    <a href="{{ route('public.umkm_detail', $product->umkm->id) }}" class="text-lg font-bold text-gray-900 hover:text-blue-600 transition-colors">
                                        {{ $product->umkm->name ?? '-' }}
                                    </a>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @if($product->umkm->whatsapp)
                                    <a href="https://wa.me/{{ $product->umkm->whatsapp }}" target="_blank"
                                       class="flex items-center justify-center gap-2 p-4 bg-green-600 text-white rounded-xl hover:bg-green-700 font-semibold transition-all shadow-lg shadow-green-500/20 transform hover:-translate-y-0.5">
                                        <i class='bx bxl-whatsapp text-xl'></i>
                                        Hubungi via WhatsApp
                                    </a>
                                @endif
                                
                                @if($product->umkm->phone)
                                    <a href="tel:{{ $product->umkm->phone }}"
                                       class="flex items-center justify-center gap-2 p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-xl hover:border-blue-500 hover:text-blue-600 font-semibold transition-all">
                                        <i class='bx bx-phone text-xl'></i>
                                        Telepon Penjual
                                    </a>
                                @endif
                            </div>
                            
                            <div class="mt-4 flex gap-3 justify-center">
                                @if($product->umkm->instagram)
                                    <a href="https://instagram.com/{{ $product->umkm->instagram }}" target="_blank" class="text-gray-400 hover:text-pink-600 transition-colors">
                                        <i class='bx bxl-instagram text-2xl'></i>
                                    </a>
                                @endif
                                @if($product->umkm->tiktok)
                                    <a href="https://tiktok.com/@{{ $product->umkm->tiktok }}" target="_blank" class="text-gray-400 hover:text-black transition-colors">
                                        <i class='bx bxl-tiktok text-2xl'></i>
                                    </a>
                                @endif
                                @if($product->umkm->website)
                                    <a href="{{ $product->umkm->website }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition-colors">
                                        <i class='bx bx-globe text-2xl'></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>