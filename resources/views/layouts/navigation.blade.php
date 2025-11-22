@php
    $isProdukActive = request()->routeIs('produk.index') || request()->routeIs('produk.detail');
    $isUmkmActive = request()->routeIs('public.umkm_index') || request()->routeIs('public.umkm_detail') || request()->is('umkm/*');
    $isHomeActive = request()->routeIs('home') && !($isProdukActive || $isUmkmActive);
    $isUmkm_Dashboard = request()->routeIs('umkm.*');
@endphp

{{-- Ultra Modern Professional Navbar --}}
<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = window.pageYOffset > 20"
     :class="scrolled ? 'bg-white/80 backdrop-blur-xl shadow-sm' : 'bg-white/60 backdrop-blur-md'"
     class="fixed top-0 w-full z-50 transition-all duration-500 border-b border-gray-200/50">
    
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="flex justify-between items-center h-16">
            
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl blur-sm opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                        <img src="{{ asset('img/shaka_utama.png') }}" alt="Logo" class="h-9 w-auto relative z-10 transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="text-xl font-bold text-blue-600 tracking-tight">
                        UMKMSmart
                    </span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-2">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 text-sm font-medium transition-all duration-300 {{ $isHomeActive ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Home
                </a>
                <a href="{{ route('public.umkm_index') }}"
                   class="px-4 py-2 text-sm font-medium transition-all duration-300 {{ $isUmkmActive ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    UMKM
                </a>
                <a href="{{ route('produk.index') }}"
                   class="px-4 py-2 text-sm font-medium transition-all duration-300 {{ $isProdukActive ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Produk
                </a>
                <a href="{{ route('artikel.index') }}"
                   class="px-4 py-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('artikel.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Artikel
                </a>
                <a href="{{ route('tentang') }}"
                   class="px-4 py-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('tentang') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Tentang
                </a>
                <a href="{{ route('contact') }}"
                   class="px-4 py-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('contact') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Kontak
                </a>
            </div>            {{-- Auth Section --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'umkm')
                        <div x-data="{ userOpen: false }" class="relative">
                            <button @click="userOpen = !userOpen"
                                    class="flex items-center gap-2.5 px-3 py-2 rounded-full hover:bg-blue-50 transition-all duration-300 group border border-blue-200/50">
                                @if(Auth::user()->role == 'umkm' && Auth::user()->umkm && Auth::user()->umkm->photo)
                                    <div class="w-8 h-8 rounded-full overflow-hidden ring-2 ring-blue-200 group-hover:ring-blue-400 transition-all">
                                        <img src="{{ asset('storage/' . Auth::user()->umkm->photo) }}"
                                             alt="{{ Auth::user()->umkm->name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ Auth::user()->role === 'admin' ? 'bg-purple-600' : 'bg-blue-600' }} text-white font-semibold text-sm shadow-md">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">{{ Str::limit(Auth::user()->name, 12) }}</span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-300" :class="userOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            {{-- Dropdown Menu --}}
                            <div x-show="userOpen" 
                                 @click.away="userOpen = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl py-2 border border-blue-200"
                                 style="display: none;">
                                
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Dashboard Admin</span>
                                    </a>
                                    <a href="{{ route('admin.notifications.index') }}" class="flex items-center justify-between px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Notifikasi</span>
                                        @if($unreadNotificationsCount > 0)
                                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadNotificationsCount }}</span>
                                        @endif
                                    </a>
                                    <div class="border-t border-blue-100 my-2"></div>
                                    <a href="{{ route('admin.umkm.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Kelola UMKM</span>
                                    </a>
                                    <a href="{{ route('admin.produk.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Kelola Produk</span>
                                    </a>
                                    <a href="{{ route('admin.kategori.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Kelola Kategori</span>
                                    </a>
                                    <a href="{{ route('admin.artikel.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Kelola Artikel</span>
                                    </a>
                                    <a href="{{ route('admin.contact.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Pesan Masuk</span>
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Edit Profile</span>
                                    </a>
                                @elseif(auth()->user()->role == 'umkm')
                                    <a href="{{ route('umkm_dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Dashboard UMKM</span>
                                    </a>
                                    <a href="{{ route('umkm.notifications.index') }}" class="flex items-center justify-between px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Notifikasi</span>
                                        @if($unreadNotificationsCount > 0)
                                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadNotificationsCount }}</span>
                                        @endif
                                    </a>
                                    <div class="border-t border-blue-100 my-2"></div>
                                    <a href="{{ route('umkm_produk') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Kelola Produk</span>
                                    </a>
                                    <a href="{{ route('umkm_editprofile') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                        <span class="font-medium">Edit Profile</span>
                                    </a>
                                @endif
                                
                                <div class="border-t border-blue-100 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input type="hidden" name="redirect" value="{{ route('home') }}">
                                    <button type="submit" class="w-full text-left px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" 
                       class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all duration-200">
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="open = !open" class="lg:hidden p-1.5 rounded-lg hover:bg-blue-50 transition-colors">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="lg:hidden bg-white border-t border-gray-100"
         style="display: none;">
        
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 rounded-lg text-sm font-medium transition-all {{ $isHomeActive ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Home
            </a>
            <a href="{{ route('public.umkm_index') }}" 
               class="block px-3 py-2 rounded-lg text-sm font-medium transition-all {{ $isUmkmActive ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                UMKM
            </a>
            <a href="{{ route('produk.index') }}" 
               class="block px-3 py-2 rounded-lg text-sm font-medium transition-all {{ $isProdukActive ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Produk
            </a>
            <a href="{{ route('artikel.index') }}" 
               class="block px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('artikel.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Artikel
            </a>
            <a href="{{ route('tentang') }}" 
               class="block px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('tentang') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Tentang
            </a>
            <a href="{{ route('contact') }}" 
               class="block px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('contact') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Kontak
            </a>

            @auth
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'umkm')
                    <div class="border-t border-gray-100 pt-3 mt-3">
                        <div class="flex items-center space-x-2 px-3 py-2 mb-2">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ Auth::user()->role === 'admin' ? 'bg-purple-600' : 'bg-blue-600' }} text-white font-semibold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                        </div>

                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Dashboard Admin</a>
                            <a href="{{ route('admin.notifications.index') }}" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">
                                <span>Notifikasi</span>
                                @if($unreadNotificationsCount > 0)
                                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadNotificationsCount }}</span>
                                @endif
                            </a>
                        @elseif(auth()->user()->role == 'umkm')
                            <a href="{{ route('umkm_dashboard') }}" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Dashboard UMKM</a>
                            <a href="{{ route('umkm.notifications.index') }}" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">
                                <span>Notifikasi</span>
                                @if($unreadNotificationsCount > 0)
                                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadNotificationsCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('umkm_produk') }}" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Kelola Produk</a>
                            <a href="{{ route('umkm_editprofile') }}" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Edit Profile</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ route('home') }}">
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg">
                                Logout
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="border-t border-gray-100 pt-3 mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-center text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-center bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- Spacer untuk fixed navbar --}}
<div class="h-16"></div>