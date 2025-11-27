@php
    $isProdukActive = request()->routeIs('produk.index') || request()->routeIs('produk.detail');
    $isUmkmActive = request()->routeIs('public.umkm_index') || request()->routeIs('public.umkm_detail') || request()->is('umkm/*');
    $isHomeActive = request()->routeIs('home') && !($isProdukActive || $isUmkmActive);
    $isUmkmRole = Auth::check() && Auth::user()->role == 'umkm';
@endphp

@if($isUmkmRole)
    {{-- 
        === NAVBAR KHUSUS UMKM (STATIC & SIMPLE) === 
        Navbar ini tidak fixed, melainkan static (ikut scroll), background putih solid.
    --}}
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-200 relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex">
                    {{-- Logo --}}
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('umkm_dashboard') }}" class="flex items-center gap-2">
                            <img src="{{ asset('img/shaka_utama.png') }}" alt="Logo" class="block h-9 w-auto">
                            <span class="font-bold text-xl text-blue-600 tracking-tight">UMKMSmart</span>
                        </a>
                    </div>

                    {{-- Desktop Navigation --}}
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('umkm_dashboard') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('umkm_dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('umkm_produk') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('umkm_produk*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Kelola Produk
                        </a>
                        <a href="{{ route('umkm_editprofile') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('umkm_editprofile') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Profil Toko
                        </a>
                        <a href="{{ route('komunitas') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('komunitas') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Komunitas
                        </a>
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 transition duration-150 ease-in-out">
                            Lihat Website
                        </a>
                    </div>
                </div>

                {{-- Settings Dropdown --}}
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            <div class="flex items-center gap-2">
                                @if(Auth::user()->umkm && Auth::user()->umkm->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->umkm->photo) }}" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-md shadow-lg origin-top-right bg-white ring-1 ring-black ring-opacity-5 py-1"
                             style="display: none;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <input type="hidden" name="redirect" value="{{ route('home') }}">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Hamburger --}}
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Responsive Navigation Menu --}}
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('umkm_dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('umkm_dashboard') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Dashboard
                </a>
                <a href="{{ route('umkm_produk') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('umkm_produk*') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Kelola Produk
                </a>
                <a href="{{ route('umkm_editprofile') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('umkm_editprofile') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Profil Toko
                </a>
                <a href="{{ route('komunitas') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('komunitas') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Komunitas
                </a>
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300">
                    Lihat Website
                </a>
            </div>

            {{-- Responsive Settings Options --}}
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="shrink-0">
                        @if(Auth::user()->umkm && Auth::user()->umkm->photo)
                            <img src="{{ asset('storage/' . Auth::user()->umkm->photo) }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ route('home') }}">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </nav>
@else
<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = window.pageYOffset > 20"
     {{-- 
        CONTAINER UTAMA:
        - Hapus class background dari sini.
        - Tinggi container mengikuti konten (transition height).
     --}}
     class="fixed top-0 w-full z-50 transition-all duration-500 ease-in-out"
     :class="scrolled ? 'h-16' : 'h-28'">
    
    {{-- 
        === BAGIAN 1: BACKGROUND (DIPISAH AGAR BISA LEBIH LEBAR) === 
    --}}
    
    {{-- Layer Background Biru Pudar (Lebih Lebar ke Bawah) --}}
    <div class="absolute top-0 left-0 w-full transition-all duration-700 ease-in-out -z-10"
         {{-- 
            LOGIKA PENTING:
            - Saat di atas (!scrolled): Tinggi h-48 (192px) -> Biru pudar memanjang ke bawah.
            - Saat di scroll: Tinggi h-full (100%) -> Mengikuti tinggi navbar yang mengecil.
         --}}
         :class="scrolled ? 'h-full bg-white/90 backdrop-blur-md shadow-md' : 'h-48 bg-gradient-to-b from-blue-600/80 via-blue-600/20 to-transparent backdrop-blur-[1px]'">
    </div>

    {{-- 
        === BAGIAN 2: KONTEN NAVBAR (LOGO & MENU) === 
        Tingginya tetap h-28 (tidak diubah jadi h-48) agar tulisan TIDAK TURUN.
    --}}
    <div class="relative max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 h-full flex flex-col justify-center">
        <div class="flex justify-between items-center">
            
            {{-- LOGO --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="relative">
                        {{-- Glow --}}
                        <div class="absolute inset-0 bg-white/30 rounded-full blur-lg opacity-0 transition-opacity duration-500"
                             :class="scrolled ? 'hidden' : 'group-hover:opacity-50'"></div>
                        
                        <img src="{{ asset('img/shaka_utama.png') }}" 
                             alt="Logo" 
                             class="w-auto relative z-10 transform group-hover:scale-105 transition-all duration-500"
                             :class="scrolled ? 'h-9 drop-shadow-none' : 'h-11 drop-shadow-md'">
                    </div>
                    {{-- Teks Logo --}}
                    <span class="font-bold tracking-tight transition-all duration-500"
                          :class="scrolled ? 'text-blue-700 text-lg' : 'text-white text-xl drop-shadow-md'">
                        UMKMSmart
                    </span>
                </a>
            </div>

            {{-- DESKTOP NAVIGATION --}}
            <div class="hidden lg:flex items-center gap-5">
                @if(Auth::check() && Auth::user()->role == 'umkm')
                    {{-- NAVIGATION KHUSUS UMKM --}}
                    
                    {{-- Menu: Dashboard --}}
                    <a href="{{ route('umkm_dashboard') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ request()->routeIs('umkm_dashboard') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ request()->routeIs('umkm_dashboard') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Dashboard
                    </a>

                    {{-- Menu: Kelola Produk --}}
                    <a href="{{ route('umkm_produk') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ request()->routeIs('umkm_produk*') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ request()->routeIs('umkm_produk*') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Kelola Produk
                    </a>

                    {{-- Menu: Profil Toko --}}
                    <a href="{{ route('umkm_editprofile') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ request()->routeIs('umkm_editprofile') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ request()->routeIs('umkm_editprofile') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Profil Toko
                    </a>

                    {{-- Menu: Komunitas --}}
                    <a href="{{ route('komunitas') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ request()->routeIs('komunitas') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ request()->routeIs('komunitas') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Komunitas
                    </a>

                    {{-- Menu: Lihat Website (Public) --}}
                    <a href="{{ route('home') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' 
                            : 'text-blue-50 hover:text-white hover:bg-white/10'">
                        Lihat Website
                    </a>

                @else
                    {{-- NAVIGATION PUBLIC --}}

                    {{-- Menu: Beranda --}}
                    <a href="{{ route('home') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ $isHomeActive ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ $isHomeActive ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Beranda
                    </a>

                    {{-- Menu: Mitra UMKM --}}
                    <a href="{{ route('public.umkm_index') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ $isUmkmActive ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ $isUmkmActive ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Mitra UMKM
                    </a>

                    {{-- Menu: Produk --}}
                    <a href="{{ route('produk.index') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ $isProdukActive ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ $isProdukActive ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Produk
                    </a>

                    {{-- Menu: Artikel --}}
                    <a href="{{ route('artikel.index') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ request()->routeIs('artikel.*') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ request()->routeIs('artikel.*') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Artikel
                    </a>

                    {{-- Menu: Komunitas --}}
                    <a href="{{ route('komunitas') }}" 
                       class="text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                       :class="scrolled 
                            ? '{{ request()->routeIs('komunitas') ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}' 
                            : '{{ request()->routeIs('komunitas') ? 'text-white font-bold border-b-2 border-white/50 rounded-none pb-1' : 'text-blue-50 hover:text-white hover:bg-white/10' }}'">
                        Komunitas
                    </a>

                    {{-- Dropdown: Info (Tentang & Kontak) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 text-sm font-medium transition-all duration-300 rounded-lg px-2 py-2"
                                :class="scrolled 
                                    ? 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' 
                                    : 'text-blue-50 hover:text-white hover:bg-white/10'">
                            Info
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute top-full right-0 mt-1 w-40 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-1"
                             style="display: none;">
                            
                            <a href="{{ route('tentang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                Tentang Kami
                            </a>
                            <a href="{{ route('contact') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                @endif
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
                    {{-- Tombol Masuk --}}
                    <a href="{{ route('login') }}" 
                       class="px-3 py-2 text-sm font-bold rounded-lg transition-colors"
                       :class="scrolled ? 'text-gray-600 hover:text-blue-600' : 'text-white hover:bg-white/10'">
                        Masuk
                    </a>
                    
                    {{-- Tombol Daftar (Reverse) --}}
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5"
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
                    <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         class="lg:hidden bg-white border-t border-gray-100 shadow-2xl relative z-50"
         style="display: none;">
        <div class="px-4 py-6 space-y-2">
            @if(Auth::check() && Auth::user()->role == 'umkm')
                {{-- MOBILE MENU UMKM --}}
                <a href="{{ route('umkm_dashboard') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('umkm_dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Dashboard</a>
                <a href="{{ route('umkm_produk') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('umkm_produk*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Kelola Produk</a>
                <a href="{{ route('umkm_editprofile') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('umkm_editprofile') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Profil Toko</a>
                <a href="{{ route('komunitas') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('komunitas') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Komunitas</a>
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-600 hover:bg-gray-50">Lihat Website</a>
            @else
                {{-- MOBILE MENU PUBLIC --}}
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ $isHomeActive ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Beranda</a>
                <a href="{{ route('public.umkm_index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ $isUmkmActive ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Mitra UMKM</a>
                <a href="{{ route('produk.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ $isProdukActive ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Produk</a>
                <a href="{{ route('artikel.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('artikel.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Artikel</a>
                <a href="{{ route('komunitas') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('komunitas') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Komunitas</a>
                <a href="{{ route('tentang') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('tentang') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Tentang Kami</a>
            @endif

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
@endif