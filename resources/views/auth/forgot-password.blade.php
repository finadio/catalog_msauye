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
                    <h1 class="text-2xl font-bold text-slate-900 mb-2">Lupa Kata Sandi?</h1>
                    <p class="text-slate-500 text-sm">Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan instruksi reset kata sandi.</p>
                </div>

                {{-- Status --}}
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm font-medium flex items-center">
                        <i class='bx bx-check-circle text-lg mr-2'></i>
                        {{ session('status') }}
                    </div>
                @endif

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

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label for="email" class="text-sm font-medium text-slate-700">Alamat Email</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all duration-200 outline-none text-slate-800 placeholder-slate-400 text-sm"
                                placeholder="nama@email.com">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">
                                <i class='bx bx-envelope text-lg'></i>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 text-sm flex items-center justify-center gap-2 transform hover:-translate-y-0.5 uppercase tracking-wider">
                        <span>Kirim Link Reset</span>
                        <i class='bx bx-send text-lg'></i>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-slate-500 hover:text-blue-700 font-medium transition-colors duration-200 text-sm">
                        <i class='bx bx-arrow-back mr-2'></i> Kembali ke Halaman Login
                    </a>
                </div>
            </div>

            {{-- Right Side: Image & Branding --}}
            <div class="hidden md:flex md:w-1/2 relative bg-blue-50 items-center justify-center p-12 overflow-hidden">
                {{-- Content --}}
                <div class="relative z-10 flex flex-col justify-center items-center text-center">
                    <div class="mb-6 p-4 rounded-full bg-white shadow-lg">
                        <i class='bx bx-shield-quarter text-5xl text-blue-600'></i>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-slate-900 mb-3">Keamanan Prioritas Kami</h2>
                    <p class="text-slate-600 text-sm max-w-xs leading-relaxed">
                        Kami menjaga keamanan data dan privasi Anda dengan standar keamanan perbankan tertinggi.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="fixed bottom-6 text-center w-full text-xs text-slate-400 pointer-events-none">
            &copy; {{ date('Y') }} BPR MSA. All rights reserved.
        </div>
    </div>
</x-guest-layout>

