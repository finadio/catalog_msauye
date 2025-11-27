<x-guest-layout>
    {{-- Kontainer utama untuk halaman register dengan desain split-panel yang lebih profesional --}}
    <div class="flex flex-col md:flex-row w-full max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden my-8 transform transition-all duration-500 animate-fade-in-up">
        {{-- Left Panel: Registration Form --}}
        <div class="w-full md:w-1/2 p-8 md:p-10 lg:p-12 flex flex-col justify-center relative animate-fade-in-left" x-data="{ currentStep: 1 }">
            <div class="mb-8 flex justify-center animate-fade-in-up delay-100">
                {{-- Menggunakan komponen logo aplikasi jika tersedia, atau gambar statis --}}
                <a href="/">
                    <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-24 w-auto object-contain hover:scale-105 transition-transform duration-300">
                </a>
            </div>

            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-4 text-gray-800 leading-tight animate-fade-in-up delay-200" x-text="currentStep === 1 ? 'Daftar Akun Pengguna' : 'Informasi UMKM Anda'"></h2>
            <p class="text-center text-gray-600 mb-8 text-base animate-fade-in-up delay-300" x-text="currentStep === 1 ? 'Buat akun untuk memulai perjalanan Anda di platform kami.' : 'Lengkapi detail usaha Anda agar kami dapat membantu mempromosikannya.'"></p>

            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md animate-fade-in-up delay-300">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="animate-fade-in-up delay-400">
                @csrf

                <div x-show="currentStep === 1" x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-10"
                     class="space-y-6 flex-1">
                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <x-text-input id="name" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Anda" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bx-user text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Email Address --}}
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <x-text-input id="email" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bx-envelope text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Kata Sandi')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <x-text-input id="password" class="block w-full pl-12 pr-12 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bx-lock-alt text-xl'></i>
                            </span>
                            <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 focus:outline-none hover:text-blue-600 transition-colors duration-200">
                                <i class='bx bx-show text-xl'></i>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <x-text-input id="password_confirmation" class="block w-full pl-12 pr-12 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi Anda" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bx-lock-alt text-xl'></i>
                            </span>
                            <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 focus:outline-none hover:text-blue-600 transition-colors duration-200">
                                <i class='bx bx-show text-xl'></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8">
                        <a class="underline text-sm text-blue-600 hover:text-blue-800 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200" href="{{ route('login') }}">
                            {{ __('Sudah terdaftar?') }}
                        </a>
                        <x-primary-button type="button" @click="currentStep = 2" class="py-3 px-8 text-lg font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800">
                            {{ __('Lanjut') }} <i class='bx bx-right-arrow-alt ml-2'></i>
                        </x-primary-button>
                    </div>
                </div>

                <div x-show="currentStep === 2" x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-10"
                     class="space-y-6 flex-1">
                    {{-- UMKM Name --}}
                    <div>
                        <x-input-label for="umkm_name" :value="__('Nama UMKM / Toko')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <x-text-input id="umkm_name" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="text" name="umkm_name" :value="old('umkm_name')" required placeholder="Nama Usaha Anda" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bx-store text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Deskripsi Singkat')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <textarea id="description" name="description" rows="3" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" required placeholder="Jelaskan produk atau layanan Anda...">{{ old('description') }}</textarea>
                            <span class="absolute left-4 top-4 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bx-detail text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Alamat Lengkap')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <textarea id="address" name="address" rows="2" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" required placeholder="Alamat lokasi usaha">{{ old('address') }}</textarea>
                            <span class="absolute left-4 top-4 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bx-map text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Phone Number --}}
                    <div class="mt-4">
                        <x-input-label for="phone_number" :value="__('Nomor WhatsApp')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <x-text-input id="phone_number" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 group-hover:border-blue-400" type="text" name="phone_number" :value="old('phone_number')" required placeholder="08xxxxxxxxxx" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200">
                                <i class='bx bxl-whatsapp text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Logo Upload --}}
                    <div class="mt-4">
                        <x-input-label for="logo" :value="__('Logo UMKM (Opsional)')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative group">
                            <input id="logo" type="file" name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-200" accept="image/*" />
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8">
                        <button type="button" @click="currentStep = 1" class="text-gray-600 hover:text-gray-900 font-medium flex items-center transition duration-200">
                            <i class='bx bx-left-arrow-alt mr-2'></i> {{ __('Kembali') }}
                        </button>
                        <x-primary-button class="py-3 px-8 text-lg font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800">
                            {{ __('Daftar Sekarang') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Right Panel: Illustration --}}
        <div class="hidden md:flex w-1/2 items-center justify-center p-8 bg-blue-50 rounded-r-3xl relative overflow-hidden animate-fade-in-right">
            {{-- Decorative Blobs --}}
            <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
            
            <img src="{{ asset('img/shaka_utama.png') }}" alt="Ilustrasi Dukungan UMKM BPR MSA" class="relative w-full max-w-lg h-auto object-contain animate-float z-10">
            
            <div class="absolute bottom-10 text-blue-900 text-center px-4 z-20 animate-fade-in-up delay-500">
                <h3 class="text-2xl font-bold mb-2">Bergabung Bersama Kami</h3>
                <p class="text-sm opacity-90">Jadilah bagian dari komunitas UMKM yang terus berkembang.</p>
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