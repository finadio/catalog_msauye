<x-guest-layout>
    {{-- Kontainer utama untuk halaman lupa password dengan desain split-panel yang profesional --}}
    <div class="flex flex-col md:flex-row w-full max-w-3xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden my-6 transform transition-all duration-300 hover:shadow-2xl">
        <div class="w-full md:w-1/2 p-5 md:p-7 lg:p-9 flex flex-col justify-center rounded-l-2xl">
            <div class="mb-8 flex justify-center">
                <a href="/">
                    <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-24 w-auto">
                </a>
            </div>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-4 text-gray-800 leading-tight">Lupa Kata Sandi Anda?</h2>
            <p class="text-center text-gray-600 mb-8 text-base">Tidak masalah. Cukup masukkan email Anda dan kami akan mengirimkan tautan reset kata sandi.</p>


            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-lg text-center">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-3 rounded-lg">
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 text-gray-700 font-medium" />
                    <div class="relative">
                        <x-text-input id="email" class="block w-full pl-12 pr-4 py-3 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition duration-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class='bx bx-envelope text-xl'></i>
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-center mt-6">
                    <x-primary-button class="w-full py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 text-white font-semibold rounded-xl text-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                        {{ __('Kirim Tautan Reset Kata Sandi') }}
                    </x-primary-button>
                </div>
            </form>
            <div class="mt-8 text-center text-sm text-gray-600">
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold underline transition duration-200">
                    &larr; Kembali ke Halaman Masuk
                </a>
            </div>
        </div>

        <div class="hidden md:flex w-1/2 items-center justify-center p-8 bg-blue-50 rounded-r-2xl">
            <img src="{{ asset('img/shaka_utama.png') }}" alt="Ilustrasi Dukungan UMKM BPR MSA" class="w-full max-w-md h-auto object-contain transform scale-95 transition-transform duration-300 hover:scale-100">
            <div class="absolute bottom-10 text-blue-900 text-center px-4">
                <h3 class="text-2xl font-bold mb-2">Lupa Kata Sandi?</h3>
                <p class="text-sm opacity-90">Kami siap membantu Anda mengembalikan akses akun Anda.</p>
            </div>
        </div>
    </div>
</x-guest-layout>