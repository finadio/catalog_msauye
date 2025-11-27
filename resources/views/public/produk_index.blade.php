<x-app-layout>
    {{-- Hero Section --}}
    <div class="relative bg-[#0B1120] pt-52 pb-24 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl"></div>
            <div class="absolute top-1/2 -left-24 w-72 h-72 rounded-full bg-purple-500/10 blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-64 h-64 rounded-full bg-indigo-500/10 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 tracking-tight">
                Jelajahi <span class="text-blue-400">Produk UMKM</span> Unggulan
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                Temukan berbagai produk unik dan berkualitas karya anak bangsa dari mitra UMKM terbaik kami.
            </p>
        </div>
    </div>


    {{-- Search & Filter Section (Overlapping) --}}
    <div class="relative -mt-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 z-20">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100">
            <form method="GET" action="{{ route('produk.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class='bx bx-search text-gray-400 text-xl'></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-800 placeholder-gray-400">
                </div>

                <div class="md:w-1/4 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class='bx bx-category text-gray-400 text-xl'></i>
                    </div>
                    <select name="kategori"
                        class="w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-800 appearance-none cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" @selected(request('kategori') == $cat->id)>{{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class='bx bx-chevron-down text-gray-400'></i>
                    </div>
                </div>

                <button type="submit"
                    class="md:w-auto px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-blue-500/30 flex items-center justify-center gap-2">
                    <span>Cari</span>
                    <i class='bx bx-right-arrow-alt'></i>
                </button>
            </form>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="bg-gray-50 pt-24 pb-24 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(request('q') || request('kategori'))
                <div class="mb-8 text-gray-600 bg-white px-6 py-4 rounded-xl shadow-sm border border-gray-100 inline-block">
                    <span class="text-gray-400 mr-2"><i class='bx bx-filter-alt'></i></span>
                    Menampilkan hasil untuk:
                    @if(request('q')) <span class="font-semibold text-gray-900">"{{ request('q') }}"</span> @endif
                    @if(request('q') && request('kategori')) &bull; @endif
                    @if(request('kategori')) <span class="font-semibold text-gray-900">Kategori Terpilih</span> @endif
                </div>
            @endif

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($products ?? [] as $product)
                    <div
                        class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full transform hover:-translate-y-1">
                        <div class="relative aspect-square overflow-hidden bg-gray-100">
                            @php
                                $productDummyImages = [
                                    'produk-dummy-1.jpg',
                                    'produk-dummy-2.jpg',
                                    'produk-dummy-3.jpg',
                                    'produk-dummy-4.jpg',
                                    'produk-dummy-5.jpg',
                                    'produk-dummy-6.jpg',
                                ];
                                $localDummyImagePath = $productDummyImages[$loop->index % count($productDummyImages)];
                            @endphp
                            <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">

                            @if($product->status->name != 'approved')
                                <span
                                    class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider z-10">
                                    {{ ucfirst($product->status->name) }}
                                </span>
                            @endif

                            {{-- Overlay Action --}}
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('produk.detail', $product->id) }}"
                                    class="px-4 py-2 bg-white text-gray-900 rounded-lg font-semibold text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 shadow-lg">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col">
                            <div class="mb-2">
                                <span
                                    class="text-[10px] uppercase tracking-wider text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded-md">
                                    {{ $product->category->name ?? 'Umum' }}
                                </span>
                            </div>
                            <h4
                                class="font-bold text-gray-900 mb-1 line-clamp-2 text-sm group-hover:text-blue-600 transition-colors leading-snug">
                                {{ $product->name }}
                            </h4>
                            <div class="mt-auto pt-3 border-t border-gray-50">
                                <p class="text-blue-600 font-bold text-base">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <p class="text-gray-400 text-xs mt-1 truncate flex items-center gap-1">
                                    <i class='bx bx-store'></i>
                                    {{ $product->umkm->name ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-16 text-center bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <i class='bx bx-search-alt text-3xl text-blue-400'></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-6 text-sm">
                            Coba gunakan kata kunci lain atau reset filter pencarian Anda.
                        </p>
                        <a href="{{ route('produk.index') }}"
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-medium shadow-lg shadow-blue-500/30 text-sm">
                            Reset Pencarian
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $products->links('vendor.pagination.modern') }}
            </div>
        </div>
    </div>
</x-app-layout>