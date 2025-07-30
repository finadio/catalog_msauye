<x-app-layout>
    <!-- Main Content with proper spacing from navbar -->
    <div class="pt-20 pb-8 min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Success Message untuk produk baru --}}
            @if(session('success'))
                <div class="mb-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 border-2 border-green-400/20 transform animate-pulse">
                    <div class="flex items-center">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 shadow-lg mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Berhasil!</h3>
                            <p class="text-green-100 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Header Section --}}
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-3">
                        Dashboard UMKM
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola produk Anda dengan mudah dan efisien</p>
                    {{-- Tampilkan info produk terbaru jika ada --}}
                    @if($products->isNotEmpty() && $products->first()->created_at->diffInMinutes(now()) < 10)
                        <div class="mt-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border-2 border-blue-200">
                            <div class="flex items-center">
                                <div class="bg-blue-500 rounded-lg p-2 mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-blue-800 font-semibold">
                                    Produk baru "{{ $products->first()->nama }}" telah ditambahkan dan sedang menunggu review.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border-2 border-blue-400/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-semibold tracking-wide">TOTAL PRODUK</p>
                            <p class="text-3xl font-bold mt-2">{{ $products->count() }}</p>
                            {{-- Indikator produk baru --}}
                            @if($products->where('created_at', '>=', now()->subDay())->count() > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-white/20 text-blue-100 mt-2">
                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-1 animate-pulse"></span>
                                    +{{ $products->where('created_at', '>=', now()->subDay())->count() }} baru
                                </span>
                            @endif
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 via-green-600 to-green-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border-2 border-green-400/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-semibold tracking-wide">PRODUK AKTIF</p>
                            <p class="text-3xl font-bold mt-2">{{ $produkAktif }}</p>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-500 via-yellow-600 to-orange-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border-2 border-yellow-400/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm font-semibold tracking-wide">MENUNGGU REVIEW</p>
                            <p class="text-3xl font-bold mt-2">{{ $menungguReview }}</p>
                            {{-- Highlight jika ada produk pending baru --}}
                            @if($products->where('status_id', '1')->where('created_at', '>=', now()->subHour())->count() > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-white/20 text-yellow-100 mt-2">
                                    <span class="w-2 h-2 bg-red-400 rounded-full mr-1 animate-pulse"></span>
                                    Baru ditambahkan
                                </span>
                            @endif
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border-2 border-red-400/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm font-semibold tracking-wide">DITOLAK</p>
                            <p class="text-3xl font-bold mt-2">{{ $ditolak }}</p>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Table Card --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-gray-100/50 backdrop-blur-sm">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-slate-50 to-blue-50 px-8 py-6 border-b-2 border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">Daftar Produk Terbaru</h2>
                            <p class="text-gray-600 font-medium">Kelola dan pantau status produk Anda</p>
                            @if($products->isNotEmpty())
                                <p class="text-sm text-blue-600 font-semibold mt-2">
                                    Terakhir diperbarui: {{ $products->max('updated_at')->diffForHumans() }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Enhanced Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-gray-300">
                        <thead class="bg-gradient-to-r from-gray-100 to-slate-200">
                            <tr>
                                <th class="px-8 py-6 text-left text-sm font-black text-gray-800 uppercase tracking-wider border-r-2 border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-blue-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <span class="text-lg">Nama Produk</span>
                                    </div>
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-black text-gray-800 uppercase tracking-wider border-r-2 border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-green-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-lg">Status</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y-2 divide-gray-200">
                            @forelse ($products->sortByDesc('created_at') as $p)
                                <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 border-b-2 border-gray-100 
                                    {{ $p->created_at->diffInMinutes(now()) < 10 ? 'bg-gradient-to-r from-green-50 to-emerald-50 border-green-200' : '' }}">
                                    <td class="px-8 py-6 border-r-2 border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-16 rounded-2xl overflow-hidden shadow-lg border-2 border-white relative">
                                                {{-- Badge untuk produk baru --}}
                                                @if($p->created_at->diffInMinutes(now()) < 30)
                                                    <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full animate-bounce">
                                                        BARU
                                                    </div>
                                                @endif
                                                <img src="{{ asset('storage/' . $p->photo) }}" alt="{{ $p->nama }}" class="object-cover w-full h-full">
                                            </div>

                                            <div class="ml-6">
                                                <div class="text-lg font-bold text-gray-900 mb-1">
                                                    {{ $p->nama }}
                                                    {{-- Tag untuk produk baru --}}
                                                    @if($p->created_at->diffInMinutes(now()) < 10)
                                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-green-500 text-white">
                                                            <span class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></span>
                                                            Baru Ditambahkan
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="text-sm font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full inline-block">
                                                    ID: #{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Dibuat: {{ $p->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 border-r-2 border-gray-200">
                                        <span class="inline-flex items-center px-4 py-2 rounded-2xl text-sm font-black shadow-md border-2 transition-all duration-300 transform hover:scale-105
                                             @if($p->status?->name == 'aktif') bg-gradient-to-r from-green-100 to-emerald-200 text-green-800 border-green-300
                                            @elseif($p->status?->name == 'pending') bg-gradient-to-r from-yellow-100 to-amber-200 text-yellow-800 border-yellow-300
                                            @elseif($p->status?->name == 'ditolak') bg-gradient-to-r from-red-100 to-rose-200 text-red-800 border-red-300
                                            @else bg-gradient-to-r from-gray-100 to-slate-200 text-gray-800 border-gray-300 @endif">
                                            @if($p->status?->name == 'aktif')
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($p->status?->name == 'pending')
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($p->status?->name == 'ditolak')
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                            {{ strtoupper($p->status->name ?? 'TIDAK DIKETAHUI') }}
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-16 text-center bg-gradient-to-br from-gray-50 to-blue-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-full p-8 mb-6 shadow-xl">
                                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-2xl font-black text-gray-800 mb-3">Belum Ada Produk</h3>
                                            <p class="text-gray-600 mb-8 max-w-sm text-lg font-medium">
                                                Anda belum menambahkan produk apapun. Mulai dengan menambahkan produk pertama Anda.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto-refresh untuk produk baru (opsional) --}}
    <script>
        // Auto-hide success message after 5 seconds
        @if(session('success'))
            setTimeout(function() {
                const successMessage = document.querySelector('.animate-pulse');
                if (successMessage) {
                    successMessage.style.transition = 'opacity 0.5s ease-out';
                    successMessage.style.opacity = '0';
                    setTimeout(() => successMessage.remove(), 500);
                }
            }, 5000);
        @endif
    </script>
</x-app-layout>