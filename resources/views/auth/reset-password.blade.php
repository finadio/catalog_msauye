<x-guest-layout :full-width="true">
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- Left Side: Form --}}
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center relative z-10">
                <div class="mb-6 text-center">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-10 w-auto mx-auto">
                    </a>
                </div>

                <div class="mb-8 text-center">
                    <h1 class="text-2xl font-bold text-slate-900 mb-2">Reset Kata Sandi</h1>
                    <p class="text-slate-500 text-sm">Silakan buat kata sandi baru untuk akun Anda.</p>
                </div>

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 text-sm font-medium text-left">
                        <div class="flex items-center mb-2">
                            <i class='bx bx-error-circle text-lg mr-2'></i>
                            <span class="font-semibold">Terjadi Kesalahan</span>
                        </div>
                        <ul class="list-disc list-inside pl-2 space-y-1 opacity-90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label for="email" class="text-sm font-medium text-slate-700">Alamat Email</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus 
                                class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all duration-200 outline-none text-slate-800 placeholder-slate-400 text-sm"
                                placeholder="nama@email.com">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">
                                <i class='bx bx-envelope text-lg'></i>
                            </div>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <label for="password" class="text-sm font-medium text-slate-700">Kata Sandi Baru</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required 
                                class="w-full pl-10 pr-12 py-3 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all duration-200 outline-none text-slate-800 placeholder-slate-400 text-sm"
                                placeholder="Minimal 8 karakter">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">
                                <i class='bx bx-lock-alt text-lg'></i>
                            </div>
                            <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors duration-200 focus:outline-none p-1">
                                <i class='bx bx-show text-lg'></i>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-sm font-medium text-slate-700">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required 
                                class="w-full pl-10 pr-12 py-3 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all duration-200 outline-none text-slate-800 placeholder-slate-400 text-sm"
                                placeholder="Ulangi password">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">
                                <i class='bx bx-check-shield text-lg'></i>
                            </div>
                            <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors duration-200 focus:outline-none p-1">
                                <i class='bx bx-show text-lg'></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 text-sm flex items-center justify-center gap-2 transform hover:-translate-y-0.5 uppercase tracking-wider">
                        <span>Reset Kata Sandi</span>
                        <i class='bx bx-reset text-lg'></i>
                    </button>
                </form>
            </div>

            {{-- Right Side: Image & Branding --}}
            <div class="hidden md:flex md:w-1/2 relative bg-blue-50 items-center justify-center p-12 overflow-hidden">
                {{-- Content --}}
                <div class="relative z-10 flex flex-col justify-center items-center text-center">
                    <div class="mb-6 p-4 rounded-full bg-white shadow-lg">
                        <i class='bx bx-lock-open-alt text-5xl text-blue-600'></i>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-slate-900 mb-3">Akses Kembali Akun Anda</h2>
                    <p class="text-slate-600 text-sm max-w-xs leading-relaxed">
                        Buat kata sandi baru yang kuat untuk melindungi akun dan data Anda.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="fixed bottom-6 text-center w-full text-xs text-slate-400 pointer-events-none">
            &copy; {{ date('Y') }} BPR MSA. All rights reserved.
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            } else {
                input.type = 'password';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            }
        }
    </script>
</x-guest-layout>
