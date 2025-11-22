@php
    $isProdukActive = request()->routeIs('produk.index') || request()->routeIs('produk.detail');
    $isUmkmActive = request()->routeIs('public.umkm_index') || request()->routeIs('public.umkm_detail') || request()->is('umkm/*');
    $isHomeActive = request()->routeIs('home') && !($isProdukActive || $isUmkmActive);
@endphp

<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = window.pageYOffset > 20"
     {{-- 
        LOGIKA WARNA (REVERSE/KEBALIKAN):
        1. Scrolled (True): Background Putih, Shadow Halus.
        2. Top (False): Background Biru Gradient Transparan.
     --}}
     :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-md' : 'bg-gradient-to-b from-blue-600/80 via-blue-600/20 to-transparent backdrop-blur-[1px]'"
     class="fixed top-0 w-full z-50 transition-all duration-500 ease-in-out">
    
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        {{-- Transisi Tinggi: Tinggi saat di atas, Pendek saat scroll --}}
        <div class="flex justify-between items-center transition-all duration-500 ease-in-out"
             :class="scrolled ? 'h-16' : 'h-28'">
            
            {{-- LOGO --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="relative">
                        {{-- Glow hanya muncul saat di posisi atas (background biru) --}}
                        <div class="absolute inset-0 bg-white/30 rounded-full blur-lg opacity-0 transition-opacity duration-500"
                             :class="scrolled ? 'hidden' : 'group-hover:opacity-50'"></div>
                        
                        <img src="{{ asset('img/shaka_utama.png') }}" 
                             alt="Logo" 
                             class="w-auto relative z-10 transform group-hover:scale-105 transition-all duration-500"
                             :class="scrolled ? 'h-9 drop-shadow-none' : 'h-11 drop-shadow-md'">
                    </div>
                    {{-- Teks Logo: Putih saat di atas, Biru saat scroll --}}
                    <span class="font-bold tracking-tight transition-all duration-500"
                          :class="scrolled ? 'text-blue-700 text-lg' : 'text-white text-xl drop-shadow-md'">
                        UMKMSmart
                    </span>
                </a>
            </div>

            {{-- DESKTOP NAVIGATION --}}
            <div class="hidden lg:flex items-center gap-8">
                {{-- 
                   LOGIKA MENU:
                   Kita menggunakan Blade untuk cek menu aktif ($isActive), 
                   lalu AlpineJS (:class) untuk cek scroll.
                --}}
                
                {{-- Menu: Beranda --}}
                <a href="{{ route('home') }}" 
                   class="text-base font-medium transition-all duration-300 rounded-lg px-3 py-2"
                   :class="scrolled 
                        ? '{{ $isHomeActive ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                        : '{{ $isHomeActive ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                    Beranda
                </a>

                {{-- Menu: Mitra UMKM --}}
                <a href="{{ route('public.umkm_index') }}" 
                   class="text-base font-medium transition-all duration-300 rounded-lg px-3 py-2"
                   :class="scrolled 
                        ? '{{ $isUmkmActive ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                        : '{{ $isUmkmActive ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                    Mitra UMKM
                </a>

                {{-- Menu: Produk --}}
                <a href="{{ route('produk.index') }}" 
                   class="text-base font-medium transition-all duration-300 rounded-lg px-3 py-2"
                   :class="scrolled 
                        ? '{{ $isProdukActive ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                        : '{{ $isProdukActive ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                    Produk
                </a>

                {{-- Menu: Artikel --}}
                <a href="{{ route('artikel.index') }}" 
                   class="text-base font-medium transition-all duration-300 rounded-lg px-3 py-2"
                   :class="scrolled 
                        ? '{{ request()->routeIs('artikel.*') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                        : '{{ request()->routeIs('artikel.*') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                    Artikel
                </a>

                {{-- Menu: Tentang --}}
                <a href="{{ route('tentang') }}" 
                   class="text-base font-medium transition-all duration-300 rounded-lg px-3 py-2"
                   :class="scrolled 
                        ? '{{ request()->routeIs('tentang') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                        : '{{ request()->routeIs('tentang') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                    Tentang
                </a>

                {{-- Menu: Kontak --}}
                <a href="{{ route('contact') }}" 
                   class="text-base font-medium transition-all duration-300 rounded-lg px-3 py-2"
                   :class="scrolled 
                        ? '{{ request()->routeIs('contact') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                        : '{{ request()->routeIs('contact') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                    Kontak
                </a>
            </div>

            {{-- AUTH SECTION --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    {{-- User Dropdown --}}
                    <div x-data="{ userOpen: false }" class="relative">
                        <button @click="userOpen = !userOpen" 
                                class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition-all duration-300 group border"
                                :class="scrolled ? 'border-gray-200 hover:bg-gray-50' : 'border-white/20 hover:bg-white/20 backdrop-blur-sm'">
                            
                            @if(Auth::user()->role == 'umkm' && Auth::user()->umkm && Auth::user()->umkm->photo)
                                <div class="rounded-full overflow-hidden ring-2 transition-all"
                                     :class="scrolled ? 'w-8 h-8 ring-blue-100' : 'w-9 h-9 ring-white/50'">
                                    <img src="{{ asset('storage/' . Auth::user()->umkm->photo) }}" alt="Foto" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="rounded-full flex items-center justify-center font-bold text-sm shadow-md transition-all"
                                     :class="scrolled ? 'w-8 h-8 bg-blue-100 text-blue-600' : 'w-9 h-9 bg-white text-blue-600'">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            
                            <div class="flex flex-col items-start">
                                <span class="text-sm font-bold leading-none transition-colors"
                                      :class="scrolled ? 'text-gray-700' : 'text-white'">
                                    {{ Str::limit(Auth::user()->name, 12) }}
                                </span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-300" 
                                 :class="[userOpen ? 'rotate-180' : '', scrolled ? 'text-gray-400' : 'text-white/80']" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        {{-- Dropdown Content (Selalu Putih) --}}
                        <div x-show="userOpen" 
                             @click.away="userOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl py-2 border border-gray-100 text-gray-800"
                             style="display: none;">
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                    Dashboard Admin
                                </a>
                            @elseif(auth()->user()->role == 'umkm')
                                <a href="{{ route('umkm_dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                    Dashboard UMKM
                                </a>
                            @endif
                            <div class="border-t border-gray-100 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <input type="hidden" name="redirect" value="{{ route('home') }}">
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Tombol Masuk (Teks berubah warna) --}}
                    <a href="{{ route('login') }}" 
                       class="px-5 py-2.5 text-sm font-bold rounded-lg transition-colors"
                       :class="scrolled ? 'text-gray-600 hover:text-blue-600' : 'text-white hover:bg-white/10'">
                        Masuk
                    </a>
                    
                    {{-- Tombol Daftar (Warna kebalikan) --}}
                    <a href="{{ route('register') }}" 
                       class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5"
                       :class="scrolled ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-white text-blue-600 hover:bg-blue-50'">
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="open = !open" class="lg:hidden p-2 rounded-lg transition-colors"
                    :class="scrolled ? 'text-gray-600 hover:bg-gray-100' : 'text-white hover:bg-white/20'">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu (Background Tetap Putih agar terbaca) --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         class="lg:hidden bg-white border-t border-gray-100 shadow-2xl"
         style="display: none;">
        <div class="px-4 py-6 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ $isHomeActive ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Beranda</a>
            <a href="{{ route('public.umkm_index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ $isUmkmActive ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Mitra UMKM</a>
            <a href="{{ route('produk.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ $isProdukActive ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Produk</a>
            <a href="{{ route('artikel.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('artikel.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Artikel</a>
            <a href="{{ route('tentang') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('tentang') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Tentang Kami</a>
            @auth
                <div class="border-t border-gray-100 pt-4 mt-4">
                    <div class="flex items-center space-x-3 px-4 py-2 mb-4 bg-blue-50/50 rounded-xl">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-600 text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <div>
                            <div class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ route('home') }}">
                        <button type="submit" class="w-full text-left px-4 py-3 text-base font-medium text-red-600 hover:bg-red-50 rounded-xl border border-red-100">Logout</button>
                    </form>
                </div>
            @else
                <div class="grid grid-cols-2 gap-4 mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-base font-bold text-gray-700">Masuk</a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg text-base font-bold">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>