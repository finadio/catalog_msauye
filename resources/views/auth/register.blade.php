<x-guest-layout>
    {{-- Kontainer utama untuk halaman register dengan desain split-panel yang lebih profesional --}}
    <div class="flex flex-col md:flex-row w-full max-w-3xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden my-6 transform transition-all duration-300 hover:shadow-2xl">
        <div class="w-full md:w-1/2 p-5 md:p-7 lg:p-9 flex flex-col justify-center rounded-l-2xl">
            <div class="mb-8 flex justify-center">
                {{-- Menggunakan komponen logo aplikasi jika tersedia, atau gambar statis --}}
                <a href="/">
                    <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-24 w-auto"> {{-- Ukuran logo sedikit diperbesar --}}
                </a>
            </div>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-4 text-gray-800 leading-tight">Buat Akun Baru</h2>
            <p class="text-center text-gray-600 mb-8 text-base">Daftar sekarang untuk menjelajahi berbagai layanan kami.</p>


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


            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf


                {{-- Name --}}
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative">
                        <x-text-input id="name" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Anda" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class='bx bx-user text-xl'></i>
                        </span>
                    </div>
                </div>


                {{-- Email Address --}}
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative">
                        <x-text-input id="email" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class='bx bx-envelope text-xl'></i>
                        </span>
                    </div>
                </div>


                {{-- Password --}}
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative">
                        <x-text-input id="password" class="block w-full pl-12 pr-12 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class='bx bx-lock-alt text-xl'></i>
                        </span>
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 focus:outline-none">
                            <i class='bx bx-show text-xl'></i>
                        </button>
                    </div>
                </div>


                {{-- Confirm Password --}}
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="block w-full pl-12 pr-12 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi Anda" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class='bx bx-lock-alt text-xl'></i>
                        </span>
                        <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 focus:outline-none">
                            <i class='bx bx-show text-xl'></i>
                        </button>
                    </div>
                </div>


                <div class="flex items-center justify-end mt-6">
                    <a class="underline text-sm text-blue-600 hover:text-blue-800 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200" href="{{ route('login') }}">
                        {{ __('Sudah terdaftar?') }}
                    </a>


                    <x-primary-button class="ml-4 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="hidden md:flex w-1/2 items-center justify-center p-8 bg-blue-50 rounded-r-2xl">
            <img src="{{ asset('img/shaka_utama.png') }}" alt="Ilustrasi Dukungan UMKM BPR MSA" class="w-full max-w-md h-auto object-contain transform scale-95 transition-transform duration-300 hover:scale-100">
            <div class="absolute bottom-10 text-blue-900 text-center px-4"> {{-- Mengubah warna teks agar terlihat di background terang --}}
                <h3 class="text-2xl font-bold mb-2">Bergabunglah dengan Komunitas UMKM Kami</h3>
                <p class="text-sm opacity-90">Dapatkan akses ke berbagai fasilitas dan dukungan untuk mengembangkan usaha Anda.</p>
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