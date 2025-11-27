<x-guest-layout>
    {{-- Kontainer utama untuk halaman login dengan desain split-panel yang lebih profesional --}}
    <div class="flex flex-col md:flex-row w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden my-6 transform transition-all duration-300 hover:shadow-2xl animate-fade-in-up">
        <div class="w-full md:w-1/2 p-5 md:p-7 lg:p-9 flex flex-col justify-center rounded-l-2xl animate-fade-in-left">
            <div class="mb-8 flex justify-center animate-fade-in-up delay-100">
                {{-- Menggunakan komponen logo aplikasi jika tersedia, atau gambar statis --}}
                <a href="/">
                    <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-24 w-auto hover:scale-105 transition-transform duration-300"> {{-- Ukuran logo sedikit diperbesar --}}
                </a>
            </div>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-4 text-gray-800 leading-tight animate-fade-in-up delay-200">Selamat Datang Kembali</h2>
            <p class="text-center text-gray-600 mb-8 text-base animate-fade-in-up delay-300">Silakan masuk untuk melanjutkan ke dashboard Anda.</p>

            {{-- Status sesi (misal: setelah reset password) --}}
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-lg text-center animate-fade-in-up delay-300">
                    {{ session('status') }}
                </div>
            @endif
            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-3 rounded-lg animate-fade-in-up delay-300">
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email Address --}}
                <div class="animate-fade-in-up delay-400">
                    <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative group">
                        <x-text-input id="email" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                            <i class='bx bx-envelope text-xl'></i>
                        </span>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mt-4 animate-fade-in-up delay-500">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative group">
                        <x-text-input id="password" class="block w-full pl-12 pr-12 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="password" name="password" required autocomplete="current-password" placeholder="Minimal 8 karakter" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                            <i class='bx bx-lock-alt text-xl'></i>
                        </span>
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 focus:outline-none hover:text-blue-600 transition-colors duration-200">
                            <i class='bx bx-show text-xl'></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between animate-fade-in-up delay-500">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 transition duration-200" name="remember">
                        <span class="ml-2 text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">{{ __('Ingat Saya') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-blue-600 hover:text-blue-800 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200" href="{{ route('password.request') }}">
                            {{ __('Lupa Kata Sandi?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-center mt-6 animate-fade-in-up delay-500">
                    <x-primary-button class="w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 active:bg-blue-800 focus:ring-blue-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600 animate-fade-in-up delay-500">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold underline transition duration-200">Daftar di sini</a>
            </div>
        </div>

        <div class="hidden md:flex w-1/2 items-center justify-center p-8 bg-blue-50 rounded-r-2xl animate-fade-in-right">
            <div class="relative w-full max-w-md">
                <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                <img src="{{ asset('img/shaka_utama.png') }}" alt="Ilustrasi Dukungan UMKM BPR MSA" class="relative w-full h-auto object-contain animate-float z-10">
            </div>
            <div class="absolute bottom-10 text-blue-900 text-center px-4 z-20 animate-fade-in-up delay-500"> {{-- Mengubah warna teks agar terlihat di background terang --}}
                <h3 class="text-2xl font-bold mb-2">Mendukung Pertumbuhan UMKM Indonesia</h3>
                <p class="text-sm opacity-90">Solusi finansial terpercaya untuk usaha mikro, kecil, dan menengah.</p>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = "<i class='bx bx-hide text-xl'></i>";
    } else {
        input.type = 'password';
        btn.innerHTML = "<i class='bx bx-show text-xl'></i>";
    }
}
</script>