<x-guest-layout :full-width="true">
    <div class="flex min-h-screen bg-white">
        {{-- Left Side: Content --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 md:px-16 lg:px-24 xl:px-32 relative z-20 bg-white">
            <div class="mb-10">
                <a href="/" class="inline-block">
                    <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-12 w-auto grayscale hover:grayscale-0 transition duration-300">
                </a>
            </div>

            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-slate-900 mb-2 tracking-tight">Pendaftaran Berhasil!</h1>
                <p class="text-slate-500 text-base">Akun Anda sedang menunggu persetujuan admin. Kami akan segera memproses data Anda.</p>
            </div>

            {{-- Status Badge --}}
            <div class="mb-8">
                <div class="inline-flex items-center px-4 py-2 bg-amber-50 border border-amber-100 text-amber-700 rounded-full text-sm font-medium">
                    <i class='bx bx-time-five text-lg mr-2'></i>
                    Menunggu Persetujuan
                </div>
            </div>

            <div class="space-y-6">
                {{-- Info Box --}}
                <div class="p-5 rounded-lg bg-slate-50 border border-slate-100">
                    <h4 class="font-semibold text-slate-900 mb-3 flex items-center">
                        <i class='bx bx-info-circle text-lg mr-2 text-slate-500'></i>
                        Informasi Penting
                    </h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li class="flex items-start">
                            <i class='bx bx-check text-emerald-500 mr-2 mt-0.5'></i>
                            <span>Proses verifikasi membutuhkan waktu 1-3 hari kerja.</span>
                        </li>
                        <li class="flex items-start">
                            <i class='bx bx-check text-emerald-500 mr-2 mt-0.5'></i>
                            <span>Admin akan meninjau kelengkapan data UMKM Anda.</span>
                        </li>
                        <li class="flex items-start">
                            <i class='bx bx-check text-emerald-500 mr-2 mt-0.5'></i>
                            <span>Pastikan informasi kontak yang diberikan aktif.</span>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ url('/') }}" class="flex-1 py-3 px-4 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 text-sm flex items-center justify-center gap-2">
                        <i class='bx bx-home-alt text-lg'></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full py-3 px-4 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
                            <i class='bx bx-log-out text-lg'></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="mt-12 pt-6 border-t border-slate-100 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} BPR MSA. All rights reserved.
            </div>
        </div>

        {{-- Right Side: Image & Branding --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-slate-50 overflow-hidden">
            {{-- Background Image --}}
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2532&auto=format&fit=crop');"></div>
            
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-slate-900/40 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>

            {{-- Content --}}
            <div class="relative z-10 flex flex-col justify-end items-start h-full p-16 text-white">
                <div class="mb-6 p-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20">
                    <i class='bx bx-time-five text-4xl text-white'></i>
                </div>
                
                <h2 class="text-3xl font-semibold mb-4 leading-tight tracking-tight">Sedang Diproses</h2>
                <p class="text-slate-200 text-base max-w-md leading-relaxed opacity-90">
                    Terima kasih telah bergabung. Kami sedang meninjau pendaftaran Anda untuk memastikan kualitas komunitas UMKM kami.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
