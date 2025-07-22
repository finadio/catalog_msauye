<x-app-layout>
    <!-- Main Content with proper spacing from navbar -->
    <div class="pt-20 pb-8 min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Header Section --}}
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-3">
                        Dashboard UMKM
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola produk Anda dengan mudah dan efisien</p>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border-2 border-blue-400/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-semibold tracking-wide">TOTAL PRODUK</p>
                            <p class="text-3xl font-bold mt-2">{{ $products->count() }}</p>
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
                            <p class="text-3xl font-bold mt-2">{{ $products->where('status.name', 'aktif')->count() }}</p>
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
                            <p class="text-3xl font-bold mt-2">{{ $products->where('status.name', 'pending')->count() }}</p>
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
                            <p class="text-3xl font-bold mt-2">{{ $products->where('status.name', 'ditolak')->count() }}</p>
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
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">Daftar Produk</h2>
                            <p class="text-gray-600 font-medium">Kelola dan pantau status produk Anda</p>
                        </div>
                        <a href="{{ route('umkm_produk.create') }}"
                           class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 via-blue-700 to-purple-700 hover:from-blue-700 hover:via-blue-800 hover:to-purple-800 text-white font-bold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl border-2 border-blue-500/20">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Produk Baru
                        </a>
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
                                <th class="px-8 py-6 text-center text-sm font-black text-gray-800 uppercase tracking-wider">
                                    <div class="flex items-center justify-center space-x-3">
                                        <div class="p-2 bg-purple-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-lg">Aksi</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y-2 divide-gray-200">
                            @forelse ($products as $p)
                                <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 border-b-2 border-gray-100">
                                    <td class="px-8 py-6 border-r-2 border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-16 bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-lg border-2 border-white">
                                                <span class="text-white font-black text-2xl">
                                                    {{ strtoupper(substr($p->nama, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="ml-6">
                                                <div class="text-lg font-bold text-gray-900 mb-1">
                                                    {{ $p->nama }}
                                                </div>
                                                <div class="text-sm font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full inline-block">
                                                    ID: #{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}
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
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex items-center justify-center space-x-4">
                                            <a href="{{ route('umkm_produk.edit', $p->id) }}"
                                               class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white text-sm font-bold rounded-xl transition-all duration-300 transform hover:scale-110 shadow-lg border-2 border-blue-400/30">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                EDIT
                                            </a>
                                            <form action="{{ route('umkm_produk.destroy', $p->id) }}" method="POST" class="inline-block"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white text-sm font-bold rounded-xl transition-all duration-300 transform hover:scale-110 shadow-lg border-2 border-red-400/30">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    HAPUS
                                                </button>
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
                                            </p>                             </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>