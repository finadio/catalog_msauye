<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative bg-black h-[650px] md:h-[800px] flex items-center justify-center text-white overflow-hidden"
             x-data="{ showHero: false }"
             x-init="setTimeout(() => showHero = true, 100)">
        {{-- Video latar belakang --}}
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0 contrast-125 saturate-110">
            <source src="{{ asset('videos/gtrb.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
        
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-black/80 z-10"></div> {{-- Overlay gradient gelap transparan --}}

        <div class="max-w-5xl mx-auto text-center relative z-20 px-6 py-10">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 tracking-tight drop-shadow-lg"
                x-show="showHero"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0">
                Gerbang Digital UMKM <br class="hidden md:inline">Binaan PT BPR MSA Yogyakarta
            </h1>
            <p class="text-base sm:text-lg md:text-xl mb-10 leading-relaxed text-gray-100 drop-shadow-md max-w-3xl mx-auto"
               x-show="showHero"
               x-transition:enter="transition ease-out duration-1000 delay-300"
               x-transition:enter-start="opacity-0 translate-y-10"
               x-transition:enter-end="opacity-100 translate-y-0">
                Jelajahi ragam produk dan layanan istimewa dari UMKM lokal terbaik di Yogyakarta. Dukung pertumbuhan ekonomi daerah bersama Bank BPR MSA!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center"
                 x-show="showHero"
                 x-transition:enter="transition ease-out duration-1000 delay-500"
                 x-transition:enter-start="opacity-0 translate-y-10"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <a href="{{ route('produk.index') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white/10 backdrop-blur-md text-white rounded-full font-semibold text-base shadow-lg border border-white/50 hover:shadow-xl hover:bg-white hover:text-blue-900 active:scale-95 transition-all duration-300 group">
                    <svg class="w-5 h-5 group-hover:text-blue-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Jelajahi Produk
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-transparent backdrop-blur-sm text-white rounded-full font-semibold text-base shadow-lg border border-white/30 hover:shadow-xl hover:bg-white/10 active:scale-95 transition-all duration-300">
                    Gabung Mitra
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>



    {{-- Feature Section (Keunggulan PT BPR MSA) --}}
    <section class="py-12 md:py-16 bg-white relative overflow-hidden border-b border-gray-100">
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-50 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float-delayed"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-10 md:mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mengapa Bermitra dengan Kami?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kami berkomitmen untuk memajukan UMKM Yogyakarta melalui ekosistem digital yang terintegrasi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6"
                 x-data="{ showFeatures: false }"
                 x-init="
                    const observer = new IntersectionObserver((entries) => {
                        if(entries[0].isIntersecting) {
                            showFeatures = true;
                            observer.disconnect();
                        }
                    }, { threshold: 0.1 });
                    observer.observe($el);
                 "
            >
                {{-- Feature 1 --}}
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
                     x-show="showFeatures"
                     x-transition:enter="ease-out duration-700"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                >
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-all duration-300 transform group-hover:rotate-3">
                        <i class='bx bx-line-chart text-3xl text-blue-600 group-hover:text-white transition-colors'></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Promosi Digital Efektif</h3>
                    <p class="text-gray-600 leading-relaxed">Tingkatkan jangkauan pasar Anda dengan platform digital kami yang dirancang khusus untuk menonjolkan keunikan produk UMKM.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
                     x-show="showFeatures"
                     x-transition:enter="ease-out duration-500 delay-100"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                >
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-600 transition-all duration-300 transform group-hover:rotate-3">
                        <i class='bx bx-book-reader text-3xl text-green-600 group-hover:text-white transition-colors'></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">Edukasi & Pendampingan</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan akses ke materi pelatihan eksklusif dan sesi mentoring untuk mengembangkan kapasitas bisnis Anda secara berkelanjutan.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
                     x-show="showFeatures"
                     x-transition:enter="ease-out duration-500 delay-200"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                >
                    <div class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition-all duration-300 transform group-hover:rotate-3">
                        <i class='bx bx-money text-3xl text-yellow-600 group-hover:text-white transition-colors'></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-yellow-600 transition-colors">Akses Permodalan Mudah</h3>
                    <p class="text-gray-600 leading-relaxed">Solusi finansial yang fleksibel dan terjangkau untuk mendukung ekspansi usaha dan kebutuhan operasional Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Category Section (Modern Grid) --}}
    <section class="py-12 md:py-16 bg-gray-50 relative overflow-hidden border-b border-gray-200">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-40 animate-float"></div>
            <div class="absolute top-1/2 -left-24 w-64 h-64 bg-indigo-100 rounded-full blur-3xl opacity-40 animate-float-delayed"></div>
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(#4F46E5 1px, transparent 1px), linear-gradient(to right, #4F46E5 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-8 md:mb-10">
                <div class="max-w-2xl text-center md:text-left w-full md:w-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 tracking-tight">
                        Kategori <span class="text-blue-600">Pilihan</span>
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Temukan berbagai produk berkualitas dari UMKM terbaik kami.
                    </p>
                </div>
                <div class="hidden md:block mb-2">
                    <a href="{{ route('produk.index') }}" class="group flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 transition-colors">
                        <span>Jelajahi Semua Kategori</span>
                        <i class='bx bx-right-arrow-alt text-2xl transform group-hover:translate-x-1 transition-transform'></i>
                    </a>
                </div>
            </div>

            <div class="relative group/section"
                 x-data="{
                    showCategories: false,
                    canScrollLeft: false,
                    canScrollRight: true,
                    checkScroll() {
                        const el = $refs.scrollContainer;
                        this.canScrollLeft = el.scrollLeft > 0;
                        this.canScrollRight = el.scrollLeft + el.clientWidth < el.scrollWidth - 10;
                    },
                    scrollLeft() {
                        $refs.scrollContainer.scrollBy({ left: -320, behavior: 'smooth' });
                    },
                    scrollRight() {
                        $refs.scrollContainer.scrollBy({ left: 320, behavior: 'smooth' });
                    }
                 }"
                 x-init="
                    const observer = new IntersectionObserver((entries) => {
                        if(entries[0].isIntersecting) {
                            showCategories = true;
                            observer.disconnect();
                        }
                    }, { threshold: 0.1 });
                    observer.observe($el);
                    
                    checkScroll();
                    $refs.scrollContainer.addEventListener('scroll', () => checkScroll());
                    window.addEventListener('resize', () => checkScroll());
                 ">
                
                <!-- Navigation Buttons -->
                <button @click="scrollLeft"
                        x-show="canScrollLeft"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-4"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 z-20 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:text-blue-600 hover:scale-110 transition-all duration-300 focus:outline-none border border-gray-100 hidden md:flex">
                    <i class='bx bx-chevron-left text-3xl'></i>
                </button>

                <button @click="scrollRight"
                        x-show="canScrollRight"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 translate-x-4"
                        class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 z-20 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:text-blue-600 hover:scale-110 transition-all duration-300 focus:outline-none border border-gray-100 hidden md:flex">
                    <i class='bx bx-chevron-right text-3xl'></i>
                </button>

                <!-- Scrollable Container -->
                <div x-ref="scrollContainer"
                     class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-8 pt-2 px-2 -mx-2 scrollbar-hide"
                     style="scrollbar-width: none; -ms-overflow-style: none;">
                    
                    <style>
                        /* Hide scrollbar for Chrome, Safari and Opera */
                        [x-ref="scrollContainer"]::-webkit-scrollbar {
                            display: none;
                        }
                    </style>

                    @forelse($categories as $cat)
                        @php
                            $categoryImageMap = [
                                'Makanan' => 'makanan.jpg',
                                'Minuman' => 'minuman.jpg',
                                'Kerajinan' => 'kerajinan.jpg',
                                'Jasa' => 'jasa.jpg',
                                'Fashion' => 'fashion.jpg',
                                'Kesehatan' => 'kesehatan.jpg',
                                'Elektronik' => 'elektronik.jpg',
                                'Rumah Tangga' => 'rumah-tangga.jpg',
                                'Pertanian' => 'pertanian.jpg',
                                'Otomotif' => 'otomotif.jpg',
                            ];
                            $localImagePath = $categoryImageMap[$cat->name] ?? 'umkm-default.png';
                            
                            // Icon mapping
                            $iconMap = [
                                'Makanan' => 'bx-dish',
                                'Minuman' => 'bx-drink',
                                'Kerajinan' => 'bx-palette',
                                'Jasa' => 'bx-briefcase-alt-2',
                                'Fashion' => 'bx-closet',
                                'Kesehatan' => 'bx-plus-medical',
                                'Elektronik' => 'bx-chip',
                                'Rumah Tangga' => 'bx-home-heart',
                                'Pertanian' => 'bx-leaf',
                                'Otomotif' => 'bx-car',
                            ];
                            $icon = $iconMap[$cat->name] ?? 'bx-category';
                        @endphp
                        <a href="{{ route('produk.index', ['kategori' => $cat->id]) }}"
                           class="flex-none w-[280px] md:w-[320px] snap-start group relative h-[360px] rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                           x-show="showCategories"
                           x-transition:enter="transition ease-out duration-700"
                           x-transition:enter-start="opacity-0 translate-y-8"
                           x-transition:enter-end="opacity-100 translate-y-0"
                           style="transition-delay: {{ $loop->index * 50 }}ms"
                        >
                            {{-- Image Background --}}
                            <div class="absolute inset-0 bg-gray-200">
                                <img src="{{ asset('img/' . $localImagePath) }}"
                                     alt="Kategori {{ $cat->name }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                            
                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>

                            {{-- Content --}}
                            <div class="absolute inset-0 p-8 flex flex-col justify-end">
                                <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white mb-4 opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100 shadow-lg group-hover:scale-110">
                                        <i class='bx {{ $icon }} text-3xl'></i>
                                    </div>
                                    <h4 class="text-3xl font-bold text-white mb-2 leading-tight">{{ $cat->name }}</h4>
                                    <p class="text-gray-300 text-sm mb-4 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                                        Temukan koleksi terbaik untuk kategori {{ strtolower($cat->name) }} dari mitra kami.
                                    </p>
                                    <div class="h-0 group-hover:h-8 overflow-hidden transition-all duration-500">
                                        <span class="inline-flex items-center gap-2 text-white font-semibold border-b border-white/50 pb-0.5 hover:border-white transition-colors">
                                            Jelajahi Produk <i class='bx bx-right-arrow-alt'></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="w-full text-center text-gray-500 py-12">Belum ada kategori.</div>
                    @endforelse
                    
                    <!-- Spacer for right padding -->
                    <div class="flex-none w-4 md:w-0"></div>
                </div>
            </div>
            
            {{-- Mobile View All Link --}}
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('produk.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                    Lihat Semua Kategori
                </a>
            </div>
        </div>
    </section>

    {{-- Flexible Section (Berita & Artikel Terbaru) --}}
    <section class="py-12 md:py-16 bg-white relative">
        <!-- Curved Divider Top -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-none rotate-180">
            <svg class="relative block w-full h-8 md:h-12" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-gray-50"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-10 md:mb-12">
                <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Blog & Berita</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Wawasan & Inspirasi</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Dapatkan informasi terbaru seputar perkembangan UMKM, tips bisnis, dan berita terkini.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                 x-data="{ showArticles: false }"
                 x-init="
                    const observer = new IntersectionObserver((entries) => {
                        if(entries[0].isIntersecting) {
                            showArticles = true;
                            observer.disconnect();
                        }
                    }, { threshold: 0.1 });
                    observer.observe($el);
                 "
            >
                @forelse($articles->take(3) as $article)
                    <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group h-full overflow-hidden border border-gray-100"
                         x-show="showArticles"
                         x-transition:enter="ease-out duration-700 delay-{{ $loop->index * 100 }}"
                         x-transition:enter-start="opacity-0 translate-y-10"
                         x-transition:enter-end="opacity-100 translate-y-0"
                    >
                        @php
                            $articleImageMap = [
                                'edukasi' => 'artikel-edukasi.jpg',
                                'berita' => 'artikel-berita.jpg',
                                'default' => 'artikel-default.jpg',
                            ];
                            $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
                        @endphp
                        
                        {{-- Image Container --}}
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $article->photo ? asset('storage/'.$article->photo) : asset('img/' . $localImagePath) }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            
                            {{-- Overlay Gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            {{-- Category Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/95 backdrop-blur-sm text-blue-600 text-xs font-bold uppercase tracking-wider rounded-full shadow-sm">
                                    {{ $article->type }}
                                </span>
                            </div>

                            {{-- Date Badge --}}
                            <div class="absolute top-4 right-4 bg-gray-900/80 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-full">
                                {{ $article->created_at->format('d M Y') }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="font-bold text-xl text-gray-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                                <a href="{{ route('artikel.detail', $article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            
                            <div class="pt-6 border-t border-gray-50 flex items-center justify-between mt-auto">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                                        <i class='bx bx-user text-sm'></i>
                                    </div>
                                    <span class="text-sm text-gray-500 font-medium">Admin</span>
                                </div>
                                <a href="{{ route('artikel.detail', $article->id) }}" class="inline-flex items-center text-blue-600 font-semibold text-sm hover:text-blue-700 group/link">
                                    Baca Artikel
                                    <i class='bx bx-right-arrow-alt ml-1 transform group-hover/link:translate-x-1 transition-transform'></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="inline-block p-4 rounded-full bg-white shadow-sm mb-4">
                            <i class='bx bx-news text-4xl text-gray-300'></i>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada artikel terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-16">
                <a href="{{ route('artikel.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 shadow-lg hover:shadow-xl hover:-translate-y-1">
                    Jelajahi Semua Artikel
                    <i class='bx bx-right-arrow-alt ml-2 text-xl'></i>
                </a>
            </div>
        </div>
        
        <!-- Curved Divider Bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-8 md:h-12" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-gray-50"></path>
            </svg>
        </div>
    </section>

    {{-- Product Cards Section --}}
    <section class="py-12 md:py-16 bg-gray-50 border-t border-gray-200" id="produk-terbaru">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">
                    Temukan <span class="text-blue-600 relative inline-block">
                        Produk Unggulan
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-blue-100 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="12" fill="none" />
                        </svg>
                    </span>
                </h2>
                <p class="text-gray-600 text-lg">
                    Jelajahi koleksi terbaik dari mitra UMKM kami yang telah terkurasi dengan standar kualitas tinggi.
                </p>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6"
                 x-data="{ showProducts: false }"
                 x-init="
                    const observer = new IntersectionObserver((entries) => {
                        if(entries[0].isIntersecting) {
                            showProducts = true;
                            observer.disconnect();
                        }
                    }, { threshold: 0.1 });
                    observer.observe($el);
                 "
            >
                @forelse($products->take(10) as $product)
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full relative transform hover:-translate-y-1"
                         x-show="showProducts"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 translate-y-10"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="transition-delay: {{ $loop->index * 100 }}ms"
                    >
                        <!-- Image -->
                        <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
                            @php
                                $productDummyImages = [
                                    'produk-dummy-1.jpg',
                                    'produk-dummy-2.jpg',
                                    'produk-dummy-3.jpg',
                                    'produk-dummy-4.jpg',
                                    'produk-dummy-5.jpg',
                                    'produk-dummy-6.jpg',
                                ];
                                $localDummyImagePath = $productDummyImages[$loop->index % count($productDummyImages)];
                            @endphp
                            <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            @if($product->status->name != 'approved')
                                <span class="absolute top-3 left-3 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider shadow-sm z-10">
                                    {{ ucfirst($product->status->name) }}
                                </span>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-4 flex flex-col flex-1">
                            <div class="mb-3">
                                <p class="text-xs text-gray-500 flex items-center gap-1 mb-1.5">
                                    <i class='bx bx-store text-blue-500'></i>
                                    <span class="truncate">{{ $product->umkm->name ?? 'UMKM' }}</span>
                                </p>
                                <h3 class="font-bold text-gray-900 text-base leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                            </div>
                            
                            <div class="mt-auto flex items-end justify-between pt-3 border-t border-gray-50">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 font-medium">Harga</span>
                                    <span class="text-lg font-bold text-blue-600">Rp {{ number_format($product->price,0,',','.') }}</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                    <i class='bx bx-right-arrow-alt text-xl'></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Full Link -->
                        <a href="{{ route('produk.detail', $product->id) }}" class="absolute inset-0 z-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-2xl" aria-label="Lihat detail {{ $product->name }}"></a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="inline-block p-4 rounded-full bg-gray-100 text-gray-400 mb-4">
                            <i class='bx bx-package text-4xl'></i>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada produk unggulan untuk ditampilkan saat ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- See All Button --}}
            <div class="mt-16 text-center">
                <a href="{{ route('produk.index') }}" class="group inline-flex items-center gap-2 px-8 py-3.5 bg-white text-blue-600 border-2 border-blue-600 rounded-full hover:bg-blue-600 hover:text-white font-bold transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-0.5">
                    <span>Lihat Semua Produk</span>
                    <i class='bx bx-right-arrow-alt text-xl group-hover:translate-x-1 transition-transform'></i>
                </a>
            </div>
        </div>
    </section>


    {{-- Footer Section --}}
        {{-- Custom CSS --}}
    <style>
    /* Memastikan custom-scrollbar-hide tetap ada */
    .custom-scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .custom-scrollbar-hide {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

    /* Custom Float Animation */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: float 6s ease-in-out 3s infinite;
    }
    </style>
</x-app-layout>