<x-app-layout>
    <!-- Main Content -->
    <div class="py-12 min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Welcome Hero Section --}}
            <div class="mb-10 relative bg-white rounded-3xl p-8 shadow-sm border border-gray-100 overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-50 to-purple-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight mb-2">
                        Selamat Datang, <span class="text-blue-600">{{ Auth::user()->name }}</span> 👋
                    </h1>
                    <p class="text-gray-600 max-w-2xl text-lg">
                        Pantau performa toko Anda dan kelola produk dengan mudah dari sini.
                    </p>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-8 bg-green-50 border border-green-200 rounded-2xl p-4 flex items-center gap-4 animate-fade-in-down">
                    <div class="bg-green-100 p-2 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-green-800 font-bold">Berhasil!</h3>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Stats Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Total Produk Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-900">{{ $products->count() }}</h3>
                        <span class="text-sm text-gray-500">Produk</span>
                    </div>
                </div>

                <!-- Produk Aktif Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-green-50 rounded-xl text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Aktif</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-900">{{ $produkAktif }}</h3>
                        <span class="text-sm text-gray-500">Tayang</span>
                    </div>
                </div>

                <!-- Menunggu Review Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-yellow-50 rounded-xl text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pending</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-900">{{ $menungguReview }}</h3>
                        <span class="text-sm text-gray-500">Review</span>
                    </div>
                </div>

                <!-- Ditolak Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-red-50 rounded-xl text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ditolak</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-900">{{ $ditolak }}</h3>
                        <span class="text-sm text-gray-500">Revisi</span>
                    </div>
                </div>
            </div>

            {{-- Komunitas Saya --}}
            <div class="mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Komunitas Saya</h2>
                    <a href="{{ route('komunitas') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                @if($communities->isEmpty())
                    <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-sm">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Bergabung dengan Komunitas</h3>
                        <p class="text-gray-500 mb-6">Bergabunglah dengan komunitas untuk memperluas jaringan UMKM Anda.</p>
                        <a href="{{ route('komunitas') }}" class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                            Jelajahi Komunitas
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($communities as $community)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 group">
                                <div class="h-32 bg-gray-100 relative overflow-hidden">
                                    @if($community->image)
                                        <img src="{{ asset('storage/' . $community->image) }}" alt="{{ $community->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600"></div>
                                    @endif
                                    <div class="absolute top-3 right-3">
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-white/90 backdrop-blur-sm shadow-sm
                                            {{ $community->pivot->status == 'approved' ? 'text-green-600' : ($community->pivot->status == 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                                            {{ ucfirst($community->pivot->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center gap-4 mb-3">
                                        <div class="w-12 h-12 rounded-xl bg-white shadow-md p-1 -mt-10 relative z-10">
                                            @if($community->logo)
                                                <img src="{{ asset('storage/' . $community->logo) }}" alt="Logo" class="w-full h-full object-contain rounded-lg">
                                            @else
                                                <div class="w-full h-full bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 text-xs font-bold">LOGO</div>
                                            @endif
                                        </div>
                                        <div class="-mt-6">
                                            <h3 class="font-bold text-gray-900 line-clamp-1 text-lg">{{ $community->name }}</h3>
                                            <p class="text-xs text-gray-500 font-medium">{{ $community->members_count ?? 0 }} Anggota</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50">
                                        <span class="text-xs font-medium px-2.5 py-1 rounded-lg bg-gray-50 text-gray-600 border border-gray-100">
                                            {{ ucfirst($community->pivot->role) }}
                                        </span>
                                        
                                        @if($community->pivot->role == 'admin' && $community->pivot->status == 'approved')
                                            <a href="{{ route('community.admin.index', $community->id) }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Kelola</a>
                                        @else
                                            <a href="{{ route('komunitas.detail', $community->id) }}" class="text-gray-600 hover:text-gray-900 text-sm font-semibold">Lihat Detail</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Main Table Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Produk Terbaru</h2>
                        <p class="text-sm text-gray-500">Status produk yang baru ditambahkan</p>
                    </div>
                    <a href="{{ route('umkm_produk') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($products->sortByDesc('created_at')->take(5) as $p)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-gray-100 overflow-hidden">
                                                <img class="h-10 w-10 object-cover" src="{{ asset('storage/' . $p->photo) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $p->nama }}</div>
                                                <div class="text-xs text-gray-500">{{ $p->category->name ?? 'Umum' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($p->status?->name == 'aktif') bg-green-100 text-green-800
                                            @elseif($p->status?->name == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($p->status?->name == 'ditolak') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($p->status->name ?? 'Unknown') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $p->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        Belum ada produk yang ditambahkan
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