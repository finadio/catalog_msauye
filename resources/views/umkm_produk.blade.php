<x-app-layout>
    <div class="min-h-screen py-12 pb-20 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header dan Search/Sort --}}
            <div class="relative mb-8 overflow-hidden rounded-3xl border border-white/20 bg-white/80 px-8 py-8 shadow-xl backdrop-blur-sm">
                {{-- Decorative background elements --}}
                <div class="absolute -mr-16 -mt-16 h-32 w-32 rounded-full bg-gradient-to-br from-blue-400/10 to-purple-400/10"></div>
                <div class="absolute -mb-12 -ml-12 h-24 w-24 rounded-full bg-gradient-to-tr from-emerald-400/10 to-blue-400/10"></div>

                <div class="relative z-10">
                    {{-- Judul Daftar Produk --}}
                    <div class="mb-2 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-r from-blue-500 to-purple-600">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h2 class="bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-3xl font-bold whitespace-nowrap text-transparent">
                            Daftar Produk
                        </h2>
                    </div>

                    {{-- Keterangan Lain --}}
                    <div class="mb-6">
                        <p class="text-gray-600 font-medium text-lg">Kelola dan pantau status produk Anda</p>
                        @if($products->isNotEmpty())
                            <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold mt-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                Terakhir diperbarui: {{ $products->max('updated_at')->diffForHumans() }}
                            </div>
                        @endif
                    </div>

                    {{-- Search, Filter, dan Tombol Tambah Produk dalam satu baris --}}
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <form method="GET" action="{{ route('umkm_produk') }}" class="flex flex-grow flex-wrap items-center gap-4">
                            {{-- Search Bar --}}
                            <div class="relative flex-1 min-w-[180px]">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="w-full rounded-xl border-2 border-gray-200 bg-white/70 py-3 pl-12 pr-4 transition-all duration-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 backdrop-blur-sm"
                                       placeholder="Cari nama produk...">
                                <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            {{-- Dropdown Urutkan Berdasarkan --}}
                            <div class="w-full md:w-40">
                                <select id="sort_by"
                                        name="sort_by"
                                        class="w-full rounded-xl border-2 border-gray-200 bg-white/70 px-4 py-3 transition-all duration-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 backdrop-blur-sm">
                                    <option value="updated_at" {{ request('sort_by') == 'updated_at' ? 'selected' : '' }}>Urut: Terbaru</option>
                                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama Produk</option>
                                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                                    <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
                                </select>
                            </div>

                            {{-- Dropdown Urutan --}}
                            <div class="w-full md:w-40">
                                <select id="sort_order"
                                        name="sort_order"
                                        class="w-full rounded-xl border-2 border-gray-200 bg-white/70 px-4 py-3 transition-all duration-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 backdrop-blur-sm">
                                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Menaik (A-Z)</option>
                                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Menurun (Z-A)</option>
                                </select>
                            </div>

                            {{-- Tombol Terapkan Filter --}}
                            <button type="submit"
                                    class="flex-shrink-0 flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition-colors duration-200 hover:bg-blue-700 w-full md:w-auto">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Terapkan
                            </button>
                        </form>

                        {{-- Tombol Tambah Produk (di luar form, agar tetap di baris yang sama) --}}
                        <div class="flex-shrink-0 w-full md:w-auto">
                            <a href="{{ route('umkm_produkcreate') }}"
                               class="group flex h-full w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-3 font-semibold text-white shadow-lg transition-all duration-200 hover:shadow-xl hover:from-emerald-600 hover:to-emerald-700">
                                <svg class="h-5 w-5 transition-transform duration-200 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Produk (tidak ada perubahan besar di sini) --}}
            <div class="overflow-hidden rounded-3xl border border-white/20 bg-white/90 shadow-2xl backdrop-blur-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-slate-100">
                            <tr>
                                <th class="px-8 py-6 text-left text-sm font-bold uppercase tracking-wider text-gray-700">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Foto
                                    </div>
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-bold uppercase tracking-wider text-gray-700">Nama Produk</th>
                                <th class="px-8 py-6 text-left text-sm font-bold uppercase tracking-wider text-gray-700">Deskripsi</th>
                                <th class="px-8 py-6 text-left text-sm font-bold uppercase tracking-wider text-gray-700">Harga</th>
                                <th class="px-8 py-6 text-left text-sm font-bold uppercase tracking-wider text-gray-700">Status</th>
                                <th class="px-8 py-6 text-center text-sm font-bold uppercase tracking-wider text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white/50">
                            @forelse ($products as $product)
                                <tr class="group transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50">
                                    <td class="px-8 py-6">
                                        <div class="relative">
                                            <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}"
                                                alt="{{ $product->name }}"
                                                class="h-20 w-28 rounded-xl border-2 border-gray-200 object-cover shadow-md transition-all duration-200 group-hover:shadow-lg">
                                            <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/10 to-transparent opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-lg font-bold text-gray-800 transition-colors duration-200 group-hover:text-blue-700">
                                            {{ $product->name }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="line-clamp-3 max-w-xs text-sm leading-relaxed text-gray-600">
                                            {{ $product->description }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-xl font-bold text-transparent">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center gap-2 rounded-full border-2 px-4 py-2 text-sm font-bold transition-all duration-200
                                            @if ($product->status->name === 'approved')
                                                bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100
                                            @elseif ($product->status->name === 'pending')
                                                bg-amber-50 text-amber-700 border-amber-200 hover:bg-amber-100
                                            @elseif ($product->status->name === 'rejected')
                                                bg-red-50 text-red-700 border-red-200 hover:bg-red-100
                                            @else
                                                bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100
                                            @endif">
                                            <div class="h-2 w-2 rounded-full
                                                @if ($product->status->name === 'approved') bg-emerald-500
                                                @elseif ($product->status->name === 'pending') bg-amber-500
                                                @elseif ($product->status->name === 'rejected') bg-red-500
                                                @else bg-gray-500
                                                @endif"></div>
                                            {{ ucfirst($product->status->name) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('umkm_produkedit', $product->id) }}"
                                                class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:shadow-lg hover:from-indigo-600 hover:to-purple-700">
                                                <svg class="h-4 w-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>

                                            {{-- Enhanced Delete Button --}}
                                            <button type="button"
                                                onclick="showDeleteModal('{{ $product->id }}', '{{ $product->name }}', '{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}')"
                                                class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-pink-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:shadow-lg hover:from-red-600 hover:to-pink-700">
                                                <svg class="h-4 w-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>

                                            {{-- Hidden Form for Delete --}}
                                            <form id="delete-form-{{ $product->id }}" action="{{ route('umkm_produkdestroy', $product->id) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-16 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-r from-gray-100 to-gray-200">
                                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <h3 class="mb-2 text-xl font-semibold text-gray-700">Belum Ada Produk</h3>
                                                <p class="mb-6 text-gray-500">Mulai tambahkan produk pertama Anda untuk ditampilkan di sini</p>
                                                <a href="{{ route('umkm_produkcreate') }}"
                                                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-200 hover:shadow-xl hover:from-blue-600 hover:to-purple-700">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                    Tambah Produk Pertama
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Custom Pagination --}}
                @if($products->count() > 0)
                    <div class="border-t border-gray-200/50 bg-gradient-to-r from-gray-50/80 to-slate-100/80 px-8 py-6 backdrop-blur-sm">
                        <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">

                            {{-- Pagination Info --}}
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <div class="rounded-full border border-gray-200/50 bg-white/60 px-4 py-2 shadow-sm backdrop-blur-sm">
                                    <span class="font-semibold text-gray-800">
                                        Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}
                                    </span>
                                    dari
                                    <span class="font-bold text-blue-600">{{ $products->total() }}</span>
                                    produk
                                </div>
                            </div>

                            {{-- Pagination Links --}}
                            <div class="flex items-center space-x-2">
                                {{-- Previous Button --}}
                                @if ($products->onFirstPage())
                                    <span class="cursor-not-allowed inline-flex items-center rounded-xl border border-gray-200/50 bg-gray-100/50 px-4 py-2 text-sm font-medium text-gray-400">
                                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $products->appends(request()->query())->previousPageUrl() }}"
                                       class="inline-flex items-center rounded-xl border border-gray-200 bg-white/70 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 hover:border-blue-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 hover:shadow-md backdrop-blur-sm">
                                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Sebelumnya
                                    </a>
                                @endif

                                {{-- Page Numbers --}}
                                <div class="flex items-center space-x-1">
                                    @php
                                        $start = max($products->currentPage() - 2, 1);
                                        $end = min($start + 4, $products->lastPage());
                                        if ($end - $start < 4) {
                                            $start = max($products->lastPage() - 4, 1);
                                        }
                                    @endphp

                                    @if($start > 1)
                                        <a href="{{ $products->appends(request()->query())->url(1) }}"
                                           class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white/70 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 hover:border-blue-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 hover:shadow-md backdrop-blur-sm">
                                            1
                                        </a>
                                        @if($start > 2)
                                            <span class="inline-flex h-10 w-10 items-center justify-center text-sm text-gray-400">...</span>
                                        @endif
                                    @endif

                                    @for ($i = $start; $i <= $end; $i++)
                                        @if ($i == $products->currentPage())
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-blue-600 bg-gradient-to-r from-blue-600 to-indigo-700 text-sm font-bold text-white shadow-lg">
                                                {{ $i }}
                                            </span>
                                        @else
                                            <a href="{{ $products->appends(request()->query())->url($i) }}"
                                               class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white/70 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 hover:border-blue-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 hover:shadow-md backdrop-blur-sm">
                                                {{ $i }}
                                            </a>
                                        @endif
                                    @endfor

                                    @if($end < $products->lastPage())
                                        @if($end < $products->lastPage() - 1)
                                            <span class="inline-flex h-10 w-10 items-center justify-center text-sm text-gray-400">...</span>
                                        @endif
                                        <a href="{{ $products->appends(request()->query())->url($products->lastPage()) }}"
                                           class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white/70 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 hover:border-blue-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 hover:shadow-md backdrop-blur-sm">
                                            {{ $products->lastPage() }}
                                        </a>
                                    @endif
                                </div>

                                {{-- Next Button --}}
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->appends(request()->query())->nextPageUrl() }}"
                                       class="inline-flex items-center rounded-xl border border-gray-200 bg-white/70 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 hover:border-blue-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 hover:shadow-md backdrop-blur-sm">
                                        Selanjutnya
                                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="cursor-not-allowed inline-flex items-center rounded-xl border border-gray-200/50 bg-gray-100/50 px-4 py-2 text-sm font-medium text-gray-400">
                                        Selanjutnya
                                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Beautiful Delete Confirmation Modal (Tidak ada perubahan) --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            {{-- Background overlay dengan animasi --}}
            <div class="fixed inset-0 bg-black/60 transition-opacity backdrop-blur-sm" id="modalOverlay"></div>

            {{-- Modal content --}}
            <div class="relative inline-block transform overflow-hidden rounded-3xl border-2 border-red-100 bg-white px-8 pb-6 pt-8 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle"
                 id="modalContent" style="transform: scale(0.8); opacity: 0;">

                {{-- Header dengan ikon warning --}}
                <div class="mb-6 text-center">
                    <div class="relative mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-r from-red-100 to-pink-100">
                        <div class="absolute inset-0 animate-pulse rounded-full bg-gradient-to-r from-red-500/20 to-pink-500/20"></div>
                        <svg class="relative z-10 h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-2xl font-bold text-gray-900">Konfirmasi Penghapusan</h3>
                    <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan</p>
                </div>

                {{-- Product info --}}
                <div class="mb-6 rounded-2xl border border-gray-200 bg-gradient-to-r from-gray-50 to-slate-100 p-6">
                    <div class="flex items-center gap-4">
                        <img id="productImage" src="" alt="" class="h-16 w-20 rounded-xl border-2 border-gray-200 object-cover shadow-sm">
                        <div class="flex-1">
                            <h4 class="mb-1 text-lg font-bold text-gray-800">Yakin ingin menghapus produk ini?</h4>
                            <p class="text-lg font-semibold text-red-600" id="productName"></p>
                            <p class="mt-1 text-sm text-gray-500">Data yang dihapus tidak dapat dikembalikan</p>
                        </div>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                    <button type="button"
                            onclick="hideDeleteModal()"
                            class="flex-1 inline-flex justify-center items-center gap-2 rounded-xl border-2 border-gray-300 bg-white px-6 py-3 font-semibold text-gray-700 shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 hover:border-gray-400 hover:bg-gray-50 hover:shadow-md">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </button>
                    <button type="button"
                            onclick="confirmDelete()"
                            class="flex-1 inline-flex justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-red-600 to-pink-600 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 hover:scale-105 hover:shadow-xl hover:from-red-700 hover:to-pink-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Ya, Hapus Produk
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Modal (Tidak ada perubahan) --}}
    <script>
        let currentProductId = null;

        function showDeleteModal(productId, productName, productImage) {
            currentProductId = productId;

            // Update modal content
            document.getElementById('productName').textContent = productName;
            document.getElementById('productImage').src = productImage;
            document.getElementById('productImage').alt = productName;

            // Show modal dengan animasi
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('modalContent');
            const modalOverlay = document.getElementById('modalOverlay');

            modal.classList.remove('hidden');

            // Animate modal entrance
            setTimeout(() => {
                modalOverlay.style.opacity = '1';
                modalContent.style.transform = 'scale(1)';
                modalContent.style.opacity = '1';
            }, 10);

            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }

        function hideDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('modalContent');
            const modalOverlay = document.getElementById('modalOverlay');

            // Animate modal exit
            modalOverlay.style.opacity = '0';
            modalContent.style.transform = 'scale(0.8)';
            modalContent.style.opacity = '0';

            setTimeout(() => {
                modal.classList.add('hidden');
                currentProductId = null;
                // Restore body scroll
                document.body.style.overflow = 'auto';
            }, 200);
        }

        function confirmDelete() {
            if (currentProductId) {
                // Add loading state to button
                const deleteBtn = event.target;
                const originalContent = deleteBtn.innerHTML;

                deleteBtn.innerHTML = `
                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menghapus...
                `;
                deleteBtn.disabled = true;

                // Submit form
                document.getElementById('delete-form-' + currentProductId).submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('modalOverlay').addEventListener('click', hideDeleteModal);

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                hideDeleteModal();
            }
        });

        // Add smooth transitions to modal
        document.getElementById('modalContent').style.transition = 'all 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
        document.getElementById('modalOverlay').style.transition = 'opacity 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
    </script>
</x-app-layout>