<x-guest-layout>
    {{-- Kontainer utama untuk halaman register dengan desain split-panel yang lebih profesional --}}
    <div class="flex flex-col md:flex-row w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden my-8 transform transition-all duration-500">
        {{-- Left Panel: Registration Form --}}
        <div class="w-full md:w-1/2 p-8 md:p-10 lg:p-12 flex flex-col justify-center relative" x-data="{ currentStep: 1 }">
            <div class="mb-8 flex justify-center">
                {{-- Menggunakan komponen logo aplikasi jika tersedia, atau gambar statis --}}
                <a href="/">
                    <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-24 w-auto object-contain">
                </a>
            </div>

            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-4 text-gray-800 leading-tight" x-text="currentStep === 1 ? 'Daftar Akun Pengguna' : 'Informasi UMKM Anda'"></h2>
            <p class="text-center text-gray-600 mb-8 text-base" x-text="currentStep === 1 ? 'Buat akun untuk memulai perjalanan Anda di platform kami.' : 'Lengkapi detail usaha Anda agar kami dapat membantu mempromosikannya.'"></p>

            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div x-show="currentStep === 1" x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-10"
                     class="space-y-6 flex-1">
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

                    <div class="flex justify-between items-center mt-8">
                        <a class="underline text-sm text-blue-600 hover:text-blue-800 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200" href="{{ route('login') }}">
                            {{ __('Sudah terdaftar?') }}
                        </a>
                        <x-primary-button type="button" @click="currentStep = 2" class="py-3 px-8 text-lg font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                            {{ __('Lanjut') }} <i class='bx bx-right-arrow-alt ml-2'></i>
                        </x-primary-button>
                    </div>
                </div>

                <div x-show="currentStep === 2" x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-10"
                     class="space-y-6 flex-1">
                    {{-- UMKM Name --}}
                    <div>
                        <x-input-label for="umkm_name" :value="__('Nama UMKM')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <x-text-input id="umkm_name" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="text" name="umkm_name" :value="old('umkm_name')" required placeholder="Nama Usaha Anda" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class='bx bx-store text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Business Type --}}
                    <div class="mt-4">
                        <x-input-label for="business_type" :value="__('Jenis Usaha')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <select id="business_type" name="business_type" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200 bg-white" required>
                                <option value="">Pilih Jenis Usaha</option>
                                <option value="Kuliner" {{ old('business_type') == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                                <option value="Fashion" {{ old('business_type') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Kerajinan" {{ old('business_type') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                <option value="Jasa" {{ old('business_type') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                <option value="Pertanian" {{ old('business_type') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                <option value="Lainnya" {{ old('business_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class='bx bx-category text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- UMKM Address --}}
                    <div class="mt-4">
                        <x-input-label for="umkm_address" :value="__('Alamat UMKM')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <textarea id="umkm_address" name="umkm_address" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" rows="3" required placeholder="Alamat lengkap UMKM Anda">{{ old('umkm_address') }}</textarea>
                            <span class="absolute left-4 top-3 text-gray-400">
                                <i class='bx bx-map text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- UMKM Phone Number --}}
                    <div class="mt-4">
                        <x-input-label for="umkm_phone" :value="__('Nomor Telepon UMKM')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <x-text-input id="umkm_phone" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="tel" name="umkm_phone" :value="old('umkm_phone')" required placeholder="Contoh: 081234567890" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class='bx bx-phone text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- WhatsApp Account --}}
                    <div class="mt-4">
                        <x-input-label for="whatsapp_account" :value="__('Akun WhatsApp (Opsional)')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <x-text-input id="whatsapp_account" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="text" name="whatsapp_account" :value="old('whatsapp_account')" placeholder="Contoh: 081234567890" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class='bx bxl-whatsapp text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Instagram Account --}}
                    <div class="mt-4">
                        <x-input-label for="instagram_account" :value="__('Akun Instagram (Opsional)')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <x-text-input id="instagram_account" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="text" name="instagram_account" :value="old('instagram_account')" placeholder="Contoh: @nama_umkm" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class='bx bxl-instagram text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- TikTok Account --}}
                    <div class="mt-4">
                        <x-input-label for="tiktok_account" :value="__('Akun TikTok (Opsional)')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <x-text-input id="tiktok_account" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="text" name="tiktok_account" :value="old('tiktok_account')" placeholder="Contoh: @nama_umkm" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class='bx bxl-tiktok text-xl'></i>
                            </span>
                        </div>
                    </div>

                    {{-- Website Title --}}
                    <div class="mt-4">
                        <x-input-label for="website_title" :value="__('Nama Website (Opsional)')" class="mb-2 text-gray-700 font-medium" />
                        <div class="relative">
                            <x-text-input id="website_title" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="text" name="website_title" :value="old('website_title')" placeholder="Contoh: Website Resmi UMKM Anda" />
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class='bx bx-globe text-xl'></i>
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8">
                        <x-secondary-button type="button" @click="currentStep = 1" class="py-3 px-8 text-lg font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                            <i class='bx bx-left-arrow-alt mr-2'></i> {{ __('Kembali') }}
                        </x-secondary-button>
                        <x-primary-button class="py-3 px-8 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                            {{ __('Daftar') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Right Panel: Illustration and Marketing Text --}}
        <div class="hidden md:flex w-1/2 items-center justify-center p-8 bg-blue-50 rounded-r-3xl relative flex-col">
            <img src="{{ asset('img/shaka_utama.png') }}" alt="Ilustrasi Dukungan UMKM BPR MSA" class="w-full max-w-md h-auto object-contain transform scale-95 transition-transform duration-300 hover:scale-100 mb-8">
            <div class="text-blue-900 text-center px-4">
                <h3 class="text-3xl font-bold mb-3">Bergabunglah dengan Komunitas UMKM Kami</h3>
                <p class="text-lg opacity-90 leading-relaxed">Dapatkan akses ke berbagai fasilitas dan dukungan untuk mengembangkan usaha Anda dan jangkau pasar yang lebih luas.</p>
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