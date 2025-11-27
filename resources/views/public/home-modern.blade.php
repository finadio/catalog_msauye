<x-app-layout>
    {{-- Modern Hero Section with Glassmorphism --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-[90vh] flex items-center justify-center overflow-hidden">
        {{-- Animated Background Video --}}
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-30">
            <source src="{{ asset('videos/gtrb.mp4') }}" type="video/mp4">
        </video>
        
        {{-- Animated Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-purple-600/20 to-pink-600/20 animate-gradient"></div>
        
        {{-- Floating Elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float-delayed"></div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            {{-- Main Heading with Gradient --}}
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black mb-6 leading-tight">
                <span class="block text-white mb-2" x-data x-init="$el.style.opacity = 0; setTimeout(() => { $el.style.transition = 'all 0.8s ease-out'; $el.style.opacity = 1; $el.style.transform = 'translateY(0)'; }, 100)" style="transform: translateY(20px)">
                    Discover Your Perfect
                </span>
                <span class="block bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent" x-data x-init="$el.style.opacity = 0; setTimeout(() => { $el.style.transition = 'all 0.8s ease-out'; $el.style.opacity = 1; $el.style.transform = 'translateY(0)'; }, 300)" style="transform: translateY(20px)">
                    UMKM Products
                </span>
            </h1>
            
            <p class="text-xl sm:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed" x-data x-init="$el.style.opacity = 0; setTimeout(() => { $el.style.transition = 'all 0.8s ease-out'; $el.style.opacity = 1; }, 600)">
                Jelajahi produk berkualitas dari UMKM binaan PT BPR MSA
            </p>

            {{-- Modern Search Card with Glassmorphism --}}
            <div class="max-w-5xl mx-auto backdrop-blur-xl bg-white/10 border border-white/20 rounded-3xl p-8 shadow-2xl" x-data x-init="$el.style.opacity = 0; setTimeout(() => { $el.style.transition = 'all 1s ease-out'; $el.style.opacity = 1; $el.style.transform = 'translateY(0)'; }, 900)" style="transform: translateY(30px)">
                <form action="{{ route('produk.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Search Input --}}
                    <div class="md:col-span-2 relative group">
                        <label class="block text-white text-sm font-semibold mb-2 text-left">Cari Produk</label>
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari produk UMKM..." 
                                class="w-full px-6 py-4 bg-white/90 backdrop-blur-sm border-0 rounded-2xl text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 transition-all duration-300 shadow-lg group-hover:shadow-xl">
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Category Filter --}}
                    <div class="relative group">
                        <label class="block text-white text-sm font-semibold mb-2 text-left">Kategori</label>
                        <select name="kategori" class="w-full px-6 py-4 bg-white/90 backdrop-blur-sm border-0 rounded-2xl text-gray-900 focus:ring-2 focus:ring-blue-400 transition-all duration-300 shadow-lg group-hover:shadow-xl appearance-none cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-4 top-[58%] w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    {{-- Search Button --}}
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 group">
                            <span>Search</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 max-w-5xl mx-auto" x-data="{ show: false }" x-init="setTimeout(() => show = true, 1200)">
                <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2" x-show="show" x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-10" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="text-4xl font-black text-white mb-2">{{ $products->count() }}+</div>
                    <div class="text-sm text-gray-300 font-medium">Produk</div>
                </div>
                <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2" x-show="show" x-transition:enter="ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 transform translate-y-10" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="text-4xl font-black text-white mb-2">{{ $categories->count() }}+</div>
                    <div class="text-sm text-gray-300 font-medium">Kategori</div>
                </div>
                <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2" x-show="show" x-transition:enter="ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 transform translate-y-10" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="text-4xl font-black text-white mb-2">100+</div>
                    <div class="text-sm text-gray-300 font-medium">UMKM</div>
                </div>
                <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2" x-show="show" x-transition:enter="ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 transform translate-y-10" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="text-4xl font-black text-white mb-2">5K+</div>
                    <div class="text-sm text-gray-300 font-medium">Pelanggan</div>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    {{-- Categories Section - Modern Grid --}}
    <section class="py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" x-data="{ show: false }" x-intersect="show = true">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4" x-show="show" x-transition:enter="ease-out duration-700" x-transition:enter-start="opacity-0 transform translate-y-10" x-transition:enter-end="opacity-100 transform translate-y-0">
                    Explore Categories
                </h2>
                <p class="text-xl text-gray-600" x-show="show" x-transition:enter="ease-out duration-700 delay-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    Temukan produk berdasarkan kategori pilihan Anda
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" x-data="{ show: false }" x-intersect="show = true">
                @foreach($categories as $index => $cat)
                    <a href="{{ route('produk.index', ['kategori' => $cat->id]) }}" 
                       class="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                       x-show="show"
                       x-transition:enter="ease-out duration-500 delay-{{ $index * 100 }}"
                       x-transition:enter-start="opacity-0 transform translate-y-10"
                       x-transition:enter-end="opacity-100 transform translate-y-0">
                        
                        @php
                            $categoryImageMap = [
                                'Makanan' => 'makanan.jpg',
                                'Minuman' => 'minuman.jpg',
                                'Kerajinan' => 'kerajinan.jpg',
                                'Jasa' => 'jasa.jpg',
                                'Fashion' => 'fashion.jpg',
                                'Kesehatan' => 'kesehatan.jpg',
                                'Elektronik' => 'elektronik.jpg',
                                'Rumah Tangga' => 'rumahtangga.jpg',
                            ];
                            $localImagePath = $categoryImageMap[$cat->name] ?? 'category-default.jpg';
                        @endphp
                        
                        <div class="aspect-[4/5] overflow-hidden">
                            <img src="{{ asset('img/' . $localImagePath) }}" 
                                 alt="{{ $cat->name }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        </div>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <h3 class="text-2xl font-bold mb-2">{{ $cat->name }}</h3>
                            <p class="text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">Lihat produk →</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Products - Modern Cards --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-16" x-data="{ show: false }" x-intersect="show = true">
                <div>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4" x-show="show" x-transition:enter="ease-out duration-700" x-transition:enter-start="opacity-0 transform -translate-x-10" x-transition:enter-end="opacity-100 transform translate-x-0">
                        Featured Products
                    </h2>
                    <p class="text-xl text-gray-600" x-show="show" x-transition:enter="ease-out duration-700 delay-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        Produk pilihan terbaik minggu ini
                    </p>
                </div>
                <a href="{{ route('produk.index') }}" 
                   class="hidden md:flex items-center gap-2 text-blue-600 font-bold hover:gap-4 transition-all duration-300 group"
                   x-show="show" 
                   x-transition:enter="ease-out duration-700 delay-200" 
                   x-transition:enter-start="opacity-0 transform translate-x-10" 
                   x-transition:enter-end="opacity-100 transform translate-x-0">
                    <span>View All</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" x-data="{ show: false }" x-intersect="show = true">
                @foreach($products->take(8) as $index => $product)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                         x-show="show"
                         x-transition:enter="ease-out duration-500 delay-{{ $index * 100 }}"
                         x-transition:enter-start="opacity-0 transform translate-y-10"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        
                        <div class="relative aspect-square overflow-hidden bg-gray-100">
                            @php
                                $productDummyImages = [
                                    'produk-dummy-1.jpg', 'produk-dummy-2.jpg', 'produk-dummy-3.jpg',
                                    'produk-dummy-4.jpg', 'produk-dummy-5.jpg', 'produk-dummy-6.jpg',
                                ];
                                $localDummyImagePath = $productDummyImages[$index % count($productDummyImages)];
                            @endphp
                            
                            <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            
                            {{-- Wishlist Button --}}
                            <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-white transition-all duration-300 shadow-lg opacity-0 group-hover:opacity-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                            
                            @if($product->status->name != 'approved')
                                <span class="absolute top-4 left-4 px-3 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                                    {{ ucfirst($product->status->name) }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($product->umkm->name ?? 'U', 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-600">{{ $product->umkm->name ?? 'UMKM' }}</span>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-2xl font-black text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="flex items-center gap-1 text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600 font-semibold">4.8</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('produk.detail', $product->id) }}" 
                               class="block w-full py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center rounded-2xl font-bold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('produk.index') }}" 
                   class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-full font-bold hover:bg-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <span>Lihat Semua Produk</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Articles Section --}}
    <section class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" x-data="{ show: false }" x-intersect="show = true">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4" x-show="show" x-transition:enter="ease-out duration-700" x-transition:enter-start="opacity-0 transform translate-y-10" x-transition:enter-end="opacity-100 transform translate-y-0">
                    Latest Insights
                </h2>
                <p class="text-xl text-gray-600" x-show="show" x-transition:enter="ease-out duration-700 delay-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    Artikel dan berita terbaru seputar UMKM
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ show: false }" x-intersect="show = true">
                @foreach($articles->take(3) as $index => $article)
                    <article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                             x-show="show"
                             x-transition:enter="ease-out duration-500 delay-{{ $index * 150 }}"
                             x-transition:enter-start="opacity-0 transform translate-y-10"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                        
                        @php
                            $articleImageMap = [
                                'edukasi' => 'artikel-edukasi.jpg',
                                'berita' => 'artikel-berita.jpg',
                                'default' => 'artikel-default.jpg',
                            ];
                            $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
                        @endphp
                        
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                            <img src="{{ $article->photo ? asset('storage/'.$article->photo) : asset('img/' . $localImagePath) }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        </div>
                        
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-4 py-1 bg-blue-100 text-blue-600 text-xs font-bold rounded-full uppercase">
                                    {{ $article->type }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ $article->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                            
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            
                            <a href="{{ route('artikel.detail', $article->id) }}" 
                               class="inline-flex items-center gap-2 text-blue-600 font-bold group-hover:gap-4 transition-all duration-300">
                                <span>Read More</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="relative py-24 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600"></div>
        <div class="absolute inset-0 bg-black/20"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
                Bergabung dengan Kami
            </h2>
            <p class="text-xl text-white/90 mb-10 leading-relaxed">
                Daftarkan UMKM Anda dan jangkau lebih banyak pelanggan
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" 
                   class="px-8 py-4 bg-white text-gray-900 rounded-full font-bold hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                    Daftar Sekarang
                </a>
                <a href="{{ route('contact') }}" 
                   class="px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white text-white rounded-full font-bold hover:bg-white/20 transition-all duration-300">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    {{-- Footer Section removed (using layout footer) --}}

    {{-- Custom Animations --}}
    <style>
        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-float-delayed {
            animation: float 8s ease-in-out infinite;
            animation-delay: 1s;
        }
    </style>
</x-app-layout>
