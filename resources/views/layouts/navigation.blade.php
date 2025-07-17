<nav x-data="{ open: false }" class="bg-white text-gray-800 shadow-md relative z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center flex-shrink-0">
            <a href="{{ route('home') }}" class="flex items-center group">
                <img src="/img/logo3.png" alt="Logo MSA BPR MSA" class="h-9 w-auto"> {{-- Logo Anda --}}
                <span class="font-extrabold text-2xl ml-3 text-blue-700">MSAcata</span> {{-- Nama Sistem --}}
            </a>
        </div>

        <!-- Navigation Links (Kanan/Tengah) -->
        <div class="hidden sm:flex items-center space-x-6">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link href="#produk-terbaru" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                {{ __('Produk') }}
            </x-nav-link>
            <x-nav-link :href="route('artikel.index')" :active="request()->routeIs('artikel.index')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                {{ __('Artikel') }}
            </x-nav-link>
            <x-nav-link :href="route('tentang')" :active="request()->routeIs('tentang')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                {{ __('Tentang Kami') }}
            </x-nav-link>
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                {{ __('Contact Us') }}
            </x-nav-link>
            {{-- Tautan dashboard admin/umkm jika user login --}}
            @auth
                @if(auth()->user()->role == 'admin')
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                        {{ __('Dashboard Admin') }}
                    </x-nav-link>
                @elseif(auth()->user()->role == 'umkm')
                    <x-nav-link :href="route('umkm.dashboard')" :active="request()->routeIs('umkm.dashboard')" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                        {{ __('Dashboard UMKM') }}
                    </x-nav-link>
                @endif
            @endauth
        </div>

        <!-- Auth Buttons / Settings Dropdown -->
        <div class="hidden sm:flex items-center ml-auto">
            @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @if(Auth::user()->role == 'umkm')
                        <x-dropdown-link :href="route('umkm.profil')">{{ __('Profil UMKM') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('umkm.produk.index')">{{ __('Kelola Produk') }}</x-dropdown-link>
                    @elseif(Auth::user()->role == 'admin')
                        <x-dropdown-link :href="route('admin.umkm.index')">{{ __('Kelola UMKM') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.produk.index')">{{ __('Kelola Produk') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.kategori.index')">{{ __('Kelola Kategori') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.artikel.index')">{{ __('Kelola Artikel') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.contact.index')">{{ __('Pesan Masuk') }}</x-dropdown-link>
                    @endif
                    <x-dropdown-link :href="route('profile.edit')">{{ __('Pengaturan Akun') }}</x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 border border-blue-500 rounded-md text-sm font-medium text-blue-600 hover:bg-blue-500 hover:text-white transition-colors duration-200">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-3 px-4 py-2 border border-transparent rounded-md text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200">Register</a>
                @endif
            @endauth
        </div>

        <!-- Hamburger (for mobile) -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-700 hover:bg-gray-100">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#produk-terbaru" class="text-gray-700 hover:bg-gray-100">
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('artikel.index')" :active="request()->routeIs('artikel.index')" class="text-gray-700 hover:bg-gray-100">
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
                @elseif(Auth::user()->role == 'umkm')
                    <x-responsive-nav-link :href="route('umkm.dashboard')" :active="request()->routeIs('umkm.dashboard')" class="text-gray-700 hover:bg-gray-100">
                        {{ __('Dashboard UMKM') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->role == 'umkm')
                    <x-dropdown-link :href="route('umkm.profil')" class="text-gray-700 hover:bg-gray-100">{{ __('Profil UMKM') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('umkm.produk.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Produk') }}</x-dropdown-link>
                @elseif(Auth::user()->role == 'admin')
                    <x-dropdown-link :href="route('admin.umkm.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola UMKM') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('admin.produk.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Produk') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('admin.kategori.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Kategori') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('admin.artikel.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Kelola Artikel') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('admin.contact.index')" class="text-gray-700 hover:bg-gray-100">{{ __('Pesan Masuk') }}</x-dropdown-link>
                @endif
                <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-gray-100">{{ __('Pengaturan Akun') }}</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-700 hover:bg-gray-100">{{ __('Log Out') }}</x-dropdown-link>
                </form>
            </div>
            @else
                <x-responsive-nav-link :href="route('login')" class="text-gray-700 hover:bg-gray-100">{{ __('Login') }}</x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')" class="text-gray-700 hover:bg-gray-100">{{ __('Register') }}</x-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>