<x-guest-layout :full-width="true">
    <div class="min-h-screen bg-slate-100 flex items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- Left Side: Form --}}
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center relative z-10">
                <div class="mb-8">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo BPR MSA" class="h-10 w-auto">
                    </a>
                </div>

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-blue-900 mb-2 tracking-tight">Konfirmasi Password</h1>
                    <p class="text-slate-500 text-sm">Ini adalah area aman. Mohon konfirmasi password Anda sebelum melanjutkan.</p>
                </div>

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 text-sm font-medium">
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

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                    @csrf

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <label for="password" class="text-sm font-medium text-slate-700">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required 
                                class="w-full pl-10 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all duration-200 outline-none text-slate-800 placeholder-slate-400 text-sm"
                                placeholder="Masukkan password Anda">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">
                                <i class='bx bx-lock-alt text-lg'></i>
                            </div>
                            <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors duration-200 focus:outline-none p-1">
                                <i class='bx bx-show text-lg'></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-blue-900 hover:bg-blue-800 text-white font-medium rounded-lg shadow-lg shadow-blue-900/20 hover:shadow-blue-900/40 transition-all duration-200 text-sm flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                        <span>Konfirmasi</span>
                        <i class='bx bx-check-circle text-lg'></i>
                    </button>
                </form>
                
                <div class="mt-8 pt-6 border-t border-slate-100 text-center text-xs text-slate-400">
                    &copy; {{ date('Y') }} BPR MSA. All rights reserved.
                </div>
            </div>

            {{-- Right Side: Image & Branding --}}
            <div class="hidden md:flex md:w-1/2 relative bg-blue-900 overflow-hidden">
                {{-- Background Image --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-50 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1614064641938-3bbee52942c7?q=80&w=2340&auto=format&fit=crop');"></div>
                
                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 opacity-90"></div>
                
                {{-- Decorative Circles --}}
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-60 h-60 rounded-full bg-white/5 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-40 h-40 rounded-full bg-white/5 blur-3xl"></div>

                {{-- Content --}}
                <div class="relative z-10 flex flex-col justify-center items-center h-full p-12 text-center text-white">
                    <div class="mb-6 p-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 shadow-xl">
                        <i class='bx bx-shield-alt-2 text-5xl text-white'></i>
                    </div>
                    
                    <h2 class="text-2xl font-bold mb-3 leading-tight">Konfirmasi Keamanan</h2>
                    <p class="text-blue-100 text-sm max-w-xs leading-relaxed opacity-90">
                        Langkah tambahan untuk memastikan bahwa ini benar-benar Anda.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="fixed bottom-6 text-center w-full text-xs text-slate-400 pointer-events-none">
            &copy; {{ date('Y') }} BPR MSA. All rights reserved.
        </div>
    </div>
</x-guest-layout>

<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = "<i class='bx bx-hide text-lg'></i>";
    } else {
        input.type = 'password';
        btn.innerHTML = "<i class='bx bx-show text-lg'></i>";
    }
}
</script>

<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = "<i class='bx bx-hide text-lg'></i>";
    } else {
        input.type = 'password';
        btn.innerHTML = "<i class='bx bx-show text-lg'></i>";
    }
}
</script>
