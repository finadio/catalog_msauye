@php
    // Logika untuk menentukan apakah menu 'Produk' harus aktif
    // Ini aktif jika kita berada di rute 'produk.index' atau 'produk.detail'
    $isProdukActive = request()->routeIs('produk.index') || request()->routeIs('produk.detail');

    // Logika untuk menentukan apakah menu 'UMKM' harus aktif
    // Aktif jika kita berada di rute UMKM publik (misalnya daftar UMKM atau detail UMKM)
    $isUmkmActive = request()->routeIs('public.umkm_index') || request()->routeIs('public.umkm_detail') || request()->is('umkm/*');

    // Menu 'Home' aktif jika kita di rute home DAN BUKAN di konteks produk atau UMKM
    $isHomeActive = request()->routeIs('home') && !($isProdukActive || $isUmkmActive);

    // Cek apakah user adalah UMKM dan sedang di halaman dashboard UMKM
    $isUmkm_Dashboard = request()->routeIs('umkm.*');
@endphp

<nav x-data="{ open: false }" class="bg-gray-50 text-gray-800 shadow-md fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
        <div class="flex items-center flex-shrink-0">
            <a href="{{ route('home') }}" class="flex items-center group -ml-2 sm:-ml-4">
                <img src="{{ asset('img/shaka_utama.png') }}" alt="Logo MSA Katalog UMKM" class="h-12 w-auto">
                <span class="font-black text-xl ml-0.5 text-blue-700 whitespace-nowrap">MSA Katalog UMKM</span>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden sm:flex items-center ml-auto space-x-6">
            {{-- Gunakan $isHomeActive --}}
            <x-nav-link :href="route('home')" :active="$isHomeActive" class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4"/></svg>
                {{ __('Home') }}
            </x-nav-link>
            {{-- Menu UMKM - Tambahan Baru --}}
            <x-nav-link :href="route('public.umkm_index')" :active="$isUmkmActive" class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                {{ __('UMKM') }}
            </x-nav-link>
            {{-- Ubah href ke route('produk.index') dan perbarui :active --}}
            <x-nav-link href="{{ route('produk.index') }}" :active="$isProdukActive" class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                {{ __('Produk') }}
            </x-nav-link>
            <x-nav-link :href="route('artikel.index')" :active="request()->routeIs('artikel.index') || request()->routeIs('artikel.detail')" class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-3m-2 20l-4-2m-4-2h8m-4 2v2m-6 2H6m10 0h2m-6 0h2"></path></svg>
                {{ __('Artikel') }}
            </x-nav-link>
            <x-nav-link :href="route('tentang')" :active="request()->routeIs('tentang')" class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ __('Tentang Kami') }}
            </x-nav-link>
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.105A9.702 9.702 0 0112 4c4.97 0 9 3.582 9 8z"></path></svg>
                {{ __('Contact Us') }}
            </x-nav-link>
            {{-- Tautan dashboard admin/umkm jika user login (dalam dropdown) --}}
            @auth
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'umkm')
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 focus:outline-none transition ease-in-out duration-150">
                                <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center mr-2">
                                    <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(auth()->user()->role == 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')" class="text-gray-700 hover:bg-gray-100">{{ __('Dashboard Admin') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.umkm.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola UMKM') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.produk.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Produk') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.kategori.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Kategori') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.artikel.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Artikel') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.contact.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Pesan Masuk') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-gray-100">{{ __('Edit Profile') }}</x-dropdown-link>
                            @elseif(auth()->user()->role == 'umkm')
                                <x-dropdown-link :href="route('umkm_dashboard')" class="text-gray-700 hover:bg-gray-100">{{ __('Dashboard UMKM') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('umkm_produk')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Produk') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('umkm_editprofile')" class="text-gray-700 hover:bg-gray-100">{{ __('Edit Profile') }}</x-dropdown-link>
                            @endif
                            
                            <!-- Fixed Logout Form with Hidden Input for Redirect -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <input type="hidden" name="redirect" value="{{ route('home') }}">
                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
            @endauth
        </div>

        <!-- Mobile menu button -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="$isHomeActive" class="text-gray-700 hover:bg-gray-100">
                {{ __('Home') }}
            </x-responsive-nav-link>
            {{-- Menu UMKM Mobile --}}
            <x-responsive-nav-link :href="route('public.umkm_index')" :active="$isUmkmActive" class="text-gray-700 hover:bg-gray-100">
                {{ __('UMKM') }}
            </x-responsive-nav-link>
            {{-- Perbarui href dan active untuk responsive nav --}}
            <x-responsive-nav-link href="{{ route('produk.index') }}" :active="$isProdukActive" class="text-gray-700 hover:bg-gray-100">
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('artikel.index')" :active="request()->routeIs('artikel.index') || request()->routeIs('artikel.detail')" class="text-gray-700 hover:bg-gray-100">
                {{ __('Artikel') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tentang')" :active="request()->routeIs('tentang')" class="text-gray-700 hover:bg-gray-100">
                {{ __('Tentang Kami') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-gray-700 hover:bg-gray-100">
                {{ __('Contact Us') }}
            </x-responsive-nav-link>
            @auth
                @if(Auth::user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-700 hover:bg-gray-100">
                        {{ __('Dashboard Admin') }}
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role == 'umkm' && !$isUmkm_Dashboard)
                    <x-responsive-nav-link :href="route('umkm_dashboard')" :active="request()->routeIs('umkm_dashboard')" class="text-gray-700 hover:bg-gray-100">
                        {{ __('Dashboard UMKM') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile User Info -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    @if(Auth::user()->role == 'umkm')
                        <x-responsive-nav-link :href="route('umkm_dashboard')" class="text-gray-700 hover:bg-gray-100">{{ __('Dashboard UMKM') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('umkm_produk')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Produk') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('umkm_editprofile')" class="text-gray-700 hover:bg-gray-100">{{ __('Edit Profile') }}</x-responsive-nav-link>
                    @elseif(Auth::user()->role == 'admin')
                        <x-responsive-nav-link :href="route('admin.umkm.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola UMKM') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.produk.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Produk') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.kategori.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Kategori') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.artikel.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Artikel') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.contact.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Pesan Masuk') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('umkm_editprofile')" class="text-gray-700 hover:bg-gray-100">{{ __('Edit Profile') }}</x-responsive-nav-link>
                    @endif
                    
                    <!-- Fixed Mobile Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ route('home') }}">
                        <x-responsive-nav-link href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-50">
                            {{ __('Logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>