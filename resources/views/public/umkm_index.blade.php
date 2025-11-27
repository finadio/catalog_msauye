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
                Jelajahi <span class="text-blue-400">UMKM Binaan</span> Kami
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                Temukan berbagai produk dan jasa berkualitas dari mitra UMKM terbaik yang telah kami kurasi untuk
                kebutuhan Anda.
            </p>
        </div>
    </div>


    {{-- Search & Filter Section (Overlapping) --}}
    <div class="relative -mt-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 z-20">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100">
            <form method="GET" action="{{ route('public.umkm_index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class='bx bx-search text-gray-400 text-xl'></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari nama UMKM, produk, atau alamat..."
                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-800 placeholder-gray-400">
                </div>

                <div class="md:w-1/4 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class='bx bx-category text-gray-400 text-xl'></i>
                    </div>
                    <select name="kategori"
                        class="w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-800 appearance-none cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
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

                @if(request('q') || request('kategori'))
                    <a href="{{ route('public.umkm_index') }}"
                        class="md:w-auto px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium rounded-xl transition-all duration-300 flex items-center justify-center"
                        title="Reset Filter">
                        <i class='bx bx-refresh text-xl'></i>
                    </a>
                @endif
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($umkms as $umkm)
                    <div
                        class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full transform hover:-translate-y-1">
                        {{-- Image --}}
                        <div class="relative h-56 overflow-hidden bg-gray-100">
                            <img src="{{ $umkm->photo ? asset('storage/' . $umkm->photo) : asset('img/umkm-default.png') }}"
                                alt="{{ $umkm->name }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500 relative z-10">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                            </div>

                            {{-- Overlay Action --}}
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-30">
                                <a href="{{ route('public.umkm_detail', $umkm->id) }}"
                                    class="block w-full py-2 bg-white/90 backdrop-blur-sm text-gray-900 text-sm font-semibold text-center rounded-lg hover:bg-white transition-colors">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-4">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                    {{ $umkm->name }}
                                </h3>
                                <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">
                                    {{ Str::limit($umkm->description, 100) }}
                                </p>
                            </div>

                            <div class="mt-auto space-y-3 border-t border-gray-100 pt-4">
                                <div class="flex items-start gap-3 text-sm text-gray-600">
                                    <i class='bx bx-map-pin text-blue-500 text-lg mt-0.5 shrink-0'></i>
                                    <span class="line-clamp-1">{{ $umkm->address }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <i class='bx bx-phone text-blue-500 text-lg shrink-0'></i>
                                    <span>{{ $umkm->phone }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-16 text-center bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <i class='bx bx-search-alt text-4xl text-blue-400'></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada UMKM ditemukan</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-6">
                            Kami tidak dapat menemukan UMKM yang sesuai dengan kriteria pencarian Anda.
                        </p>
                        <a href="{{ route('public.umkm_index') }}"
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-medium shadow-lg shadow-blue-500/30">
                            Reset Pencarian
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $umkms->links('vendor.pagination.modern') }}
            </div>
        </div>
    </div>
</x-app-layout>