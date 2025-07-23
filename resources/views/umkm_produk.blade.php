<x-app-layout>
    <div class="pt-20 pb-12 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header dan Search --}}
            <div class="bg-white/80 backdrop-blur-sm px-8 py-8 rounded-3xl border border-white/20 shadow-xl mb-8 relative overflow-hidden">
                <!-- Decorative Background Elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-emerald-400/10 to-blue-400/10 rounded-full -ml-12 -mb-12"></div>
                
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 relative z-10">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                Daftar Produk
                            </h2>
                        </div>
                        <p class="text-gray-600 font-medium text-lg">Kelola dan pantau status produk Anda</p>
                        @if($products->isNotEmpty())
                            <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                Terakhir diperbarui: {{ $products->max('updated_at')->diffForHumans() }}
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                        {{-- Search Form --}}
                        <form method="GET" action="{{ route('umkm_produk') }}" class="flex w-full sm:w-auto">
                            <div class="relative flex-1 sm:w-72">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="w-full pl-12 pr-4 py-3 rounded-l-2xl border-2 border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-200"
                                    placeholder="Cari nama produk...">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-r-2xl shadow-lg hover:shadow-xl transition-all duration-200 font-semibold">
                                Cari
                            </button>
                        </form>

                        {{-- Tambah Produk --}}
                        <a href="{{ route('umkm_produkcreate') }}"
                            class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 text-center flex items-center justify-center gap-2 group">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Produk
                        </a>
                    </div>
                </div>
            </div>

            {{-- Table Produk --}}
            <div class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-slate-100">
                            <tr>
                                <th class="px-8 py-6 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Foto
                                    </div>
                                </th>
                                <th class="px-8 py-6 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">Nama Produk</th>
                                <th class="px-8 py-6 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">Deskripsi</th>
                                <th class="px-8 py-6 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">Harga</th>
                                <th class="px-8 py-6 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">Status</th>
                                <th class="px-8 py-6 text-center font-bold text-gray-700 text-sm uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white/50">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50 transition-all duration-200 group">
                                    <td class="px-8 py-6">
                                        <div class="relative">
                                            <img src="{{ asset('img/' . $product->photo) }}"
                                                alt="{{ $product->name }}"
                                                class="h-20 w-28 object-cover rounded-xl border-2 border-gray-200 shadow-md group-hover:shadow-lg transition-all duration-200">
                                            <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-gray-800 text-lg group-hover:text-blue-700 transition-colors duration-200">
                                            {{ $product->name }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-gray-600 text-sm leading-relaxed line-clamp-3 max-w-xs">
                                            {{ $product->description }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center gap-2 text-sm font-bold px-4 py-2 rounded-full border-2 transition-all duration-200
                                            @if ($product->status->name === 'aktif') 
                                                bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100
                                            @elseif ($product->status->name === 'pending') 
                                                bg-amber-50 text-amber-700 border-amber-200 hover:bg-amber-100
                                            @elseif ($product->status->name === 'ditolak') 
                                                bg-red-50 text-red-700 border-red-200 hover:bg-red-100
                                            @else 
                                                bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100
                                            @endif">
                                            <div class="w-2 h-2 rounded-full
                                                @if ($product->status->name === 'aktif') bg-emerald-500
                                                @elseif ($product->status->name === 'pending') bg-amber-500
                                                @elseif ($product->status->name === 'ditolak') bg-red-500
                                                @else bg-gray-500
                                                @endif"></div>
                                            {{ ucfirst($product->status->name) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('umkm_produkedit', $product->id) }}"
                                                class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 group">
                                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            
                                            {{-- Enhanced Delete Button --}}
                                            <button type="button"
                                                onclick="showDeleteModal('{{ $product->id }}', '{{ $product->name }}', '{{ asset('img/' . $product->photo) }}')"
                                                class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 group">
                                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <td colspan="6" class="text-center py-16">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="w-20 h-20 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Produk</h3>
                                                <p class="text-gray-500 mb-6">Mulai tambahkan produk pertama Anda untuk ditampilkan di sini</p>
                                                <a href="{{ route('umkm_produkcreate') }}" 
                                                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                @if($products->total() > 0)
                    <div class="bg-gradient-to-r from-gray-50/80 to-slate-100/80 backdrop-blur-sm px-8 py-6 border-t border-gray-200/50">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                            
                            {{-- Pagination Info --}}
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <div class="bg-white/60 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-200/50 shadow-sm">
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
                                    <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100/50 border border-gray-200/50 rounded-xl cursor-not-allowed">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $products->appends(request()->query())->previousPageUrl() }}" 
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white/70 border border-gray-200 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:border-blue-300 hover:text-blue-700 transition-all duration-200 shadow-sm hover:shadow-md backdrop-blur-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        $start = max($end - 4, 1);
                                    @endphp

                                    @if($start > 1)
                                        <a href="{{ $products->appends(request()->query())->url(1) }}" 
                                           class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white/70 border border-gray-200 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:border-blue-300 hover:text-blue-700 transition-all duration-200 shadow-sm hover:shadow-md backdrop-blur-sm">
                                            1
                                        </a>
                                        @if($start > 2)
                                            <span class="inline-flex items-center justify-center w-10 h-10 text-sm text-gray-400">...</span>
                                        @endif
                                    @endif

                                    @for ($i = $start; $i <= $end; $i++)
                                        @if ($i == $products->currentPage())
                                            <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-700 border border-blue-600 rounded-xl shadow-lg">
                                                {{ $i }}
                                            </span>
                                        @else
                                            <a href="{{ $products->appends(request()->query())->url($i) }}" 
                                               class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white/70 border border-gray-200 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:border-blue-300 hover:text-blue-700 transition-all duration-200 shadow-sm hover:shadow-md backdrop-blur-sm">
                                                {{ $i }}
                                            </a>
                                        @endif
                                    @endfor

                                    @if($end < $products->lastPage())
                                        @if($end < $products->lastPage() - 1)
                                            <span class="inline-flex items-center justify-center w-10 h-10 text-sm text-gray-400">...</span>
                                        @endif
                                        <a href="{{ $products->appends(request()->query())->url($products->lastPage()) }}" 
                                           class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white/70 border border-gray-200 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:border-blue-300 hover:text-blue-700 transition-all duration-200 shadow-sm hover:shadow-md backdrop-blur-sm">
                                            {{ $products->lastPage() }}
                                        </a>
                                    @endif
                                </div>

                                {{-- Next Button --}}
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->appends(request()->query())->nextPageUrl() }}" 
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white/70 border border-gray-200 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:border-blue-300 hover:text-blue-700 transition-all duration-200 shadow-sm hover:shadow-md backdrop-blur-sm">
                                        Selanjutnya
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100/50 border border-gray-200/50 rounded-xl cursor-not-allowed">
                                        Selanjutnya
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    {{-- Beautiful Delete Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            {{-- Background overlay dengan animasi --}}
            <div class="fixed inset-0 transition-opacity bg-black/60 backdrop-blur-sm" id="modalOverlay"></div>

            {{-- Modal content --}}
            <div class="inline-block align-bottom bg-white rounded-3xl px-8 pt-8 pb-6 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border-2 border-red-100" 
                 id="modalContent" style="transform: scale(0.8); opacity: 0;">
                
                {{-- Header dengan ikon warning --}}
                <div class="text-center mb-6">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-red-100 to-pink-100 mb-4 relative">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-red-500/20 to-pink-500/20 animate-pulse"></div>
                        <svg class="h-10 w-10 text-red-600 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Penghapusan</h3>
                    <p class="text-gray-500 text-sm">Tindakan ini tidak dapat dibatalkan</p>
                </div>

                {{-- Product info --}}
                <div class="bg-gradient-to-r from-gray-50 to-slate-100 rounded-2xl p-6 mb-6 border border-gray-200">
                    <div class="flex items-center gap-4">
                        <img id="productImage" src="" alt="" class="h-16 w-20 object-cover rounded-xl border-2 border-gray-200 shadow-sm">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800 text-lg mb-1">Yakin ingin menghapus produk ini?</h4>
                            <p class="text-red-600 font-semibold text-lg" id="productName"></p>
                            <p class="text-gray-500 text-sm mt-1">Data yang dihapus tidak dapat dikembalikan</p>
                        </div>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <button type="button" 
                            onclick="hideDeleteModal()"
                            class="flex-1 inline-flex justify-center items-center gap-2 px-6 py-3 bg-white border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </button>
                    <button type="button" 
                            onclick="confirmDelete()"
                            class="flex-1 inline-flex justify-center items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Ya, Hapus Produk
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Modal --}}
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