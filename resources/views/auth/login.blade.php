<x-guest-layout>
    {{-- Kontainer utama untuk halaman login dengan desain split-panel yang lebih profesional --}}
    <div class="flex flex-col md:flex-row w-full max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden my-8 transform transition-all duration-300 hover:shadow-2xl">
        <!-- Kiri: Form Login -->
        <div class="w-full md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center">
            <div class="mb-8 flex justify-center">
                {{-- Menggunakan komponen logo aplikasi jika tersedia, atau gambar statis --}}
                <a href="/">
                    <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-24 w-auto"> {{-- Ukuran logo sedikit diperbesar --}}
                </a>
            </div>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-4 text-gray-800 leading-tight">Selamat Datang Kembali</h2>
            <p class="text-center text-gray-600 mb-8 text-base">Silakan masuk untuk melanjutkan ke dashboard Anda.</p>

            {{-- Status sesi (misal: setelah reset password) --}}
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-lg text-center">
                    {{ session('status') }}
                </div>
            @endif
            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-3 rounded-lg">
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email Address --}}
                <div>
                    <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative">
                        <x-text-input id="email" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class='bx bx-envelope text-xl'></i>
                        </span>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative">
                        <x-text-input id="password" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="password" name="password" required autocomplete="current-password" placeholder="Minimal 8 karakter" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class='bx bx-lock-alt text-xl'></i>
                        </span>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm text-gray-700">{{ __('Ingat Saya') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-blue-600 hover:text-blue-800 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200" href="{{ route('password.request') }}">
                            {{ __('Lupa Kata Sandi?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-center mt-6">
                    <x-primary-button class="w-full py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold underline transition duration-200">Daftar di sini</a>
            </div>
        </div>

        <!-- Kanan: Ilustrasi/Gambar Latar Belakang -->
        {{-- Mengganti latar belakang gambar dengan warna polos --}}
        <div class="hidden md:flex w-1/2 bg-blue-50 items-center justify-center p-8 relative">
            <img src="{{ asset('img/shaka_utama.png') }}" alt="Ilustrasi Dukungan UMKM BPR MSA" class="w-full max-w-md h-auto object-contain rounded-lg shadow-lg transform scale-95 transition-transform duration-300 hover:scale-100">
            <div class="absolute bottom-10 text-blue-900 text-center px-4"> {{-- Mengubah warna teks agar terlihat di background terang --}}
                <h3 class="text-2xl font-bold mb-2">Mendukung Pertumbuhan UMKM Indonesia</h3>
                <p class="text-sm opacity-90">Solusi finansial terpercaya untuk usaha mikro, kecil, dan menengah.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
