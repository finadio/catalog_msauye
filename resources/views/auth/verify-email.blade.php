<x-guest-layout :full-width="true">
    <div class="min-h-screen bg-slate-100 flex items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- Left Side: Content --}}
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center relative z-10">
                <div class="mb-8">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-10 w-auto">
                    </a>
                </div>

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-blue-900 mb-2 tracking-tight">Verifikasi Email</h1>
                    <p class="text-slate-500 text-sm">Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan.</p>
                </div>

                {{-- Status --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 p-4 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm font-medium flex items-center">
                        <i class='bx bx-check-circle text-lg mr-2'></i>
                        {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full py-3 px-4 bg-blue-900 hover:bg-blue-800 text-white font-medium rounded-lg shadow-lg shadow-blue-900/20 hover:shadow-blue-900/40 transition-all duration-200 text-sm flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                            <span>Kirim Ulang Email Verifikasi</span>
                            <i class='bx bx-send text-lg'></i>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-3 px-4 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                            <i class='bx bx-log-out text-lg'></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
                
                <div class="mt-8 pt-6 border-t border-slate-100 text-center text-xs text-slate-400">
                    &copy; {{ date('Y') }} BPR MSA. All rights reserved.
                </div>
            </div>

            {{-- Right Side: Image & Branding --}}
            <div class="hidden md:flex md:w-1/2 relative bg-blue-900 overflow-hidden">
                {{-- Background Image --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-50 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1596524430615-b46475ddff6e?q=80&w=2340&auto=format&fit=crop');"></div>
                
                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 opacity-90"></div>
                
                {{-- Decorative Circles --}}
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-60 h-60 rounded-full bg-white/5 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-40 h-40 rounded-full bg-white/5 blur-3xl"></div>

                {{-- Content --}}
                <div class="relative z-10 flex flex-col justify-center items-center h-full p-12 text-center text-white">
                    <div class="mb-6 p-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 shadow-xl">
                        <i class='bx bx-envelope text-5xl text-white'></i>
                    </div>
                    
                    <h2 class="text-2xl font-bold mb-3 leading-tight">Cek Kotak Masuk Anda</h2>
                    <p class="text-blue-100 text-sm max-w-xs leading-relaxed opacity-90">
                        Kami telah mengirimkan email verifikasi untuk memastikan keamanan akun Anda.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="fixed bottom-6 text-center w-full text-xs text-slate-400 pointer-events-none">
            &copy; {{ date('Y') }} BPR MSA. All rights reserved.
        </div>
    </div>
</x-guest-layout>
