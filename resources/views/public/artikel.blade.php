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
                Wawasan & <span class="text-blue-400">Inspirasi</span> UMKM
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                Temukan artikel edukatif, berita terbaru, dan tips sukses untuk mengembangkan bisnis UMKM Anda.
            </p>
        </div>
    </div>

    {{-- Search & Filter Section (Overlapping) --}}
    <div class="relative -mt-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 z-20">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100">
            <form method="GET" action="{{ route('artikel.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class='bx bx-search text-gray-400 text-xl'></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari artikel (judul atau isi)..."
                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-800 placeholder-gray-400">
                </div>

                <div class="md:w-1/4 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class='bx bx-category text-gray-400 text-xl'></i>
                    </div>
                    <select name="tipe"
                        class="w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-800 appearance-none cursor-pointer">
                        <option value="">Semua Tipe</option>
                        @foreach($articleTypes as $type)
                            <option value="{{ $type }}" {{ request('tipe') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
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

            @if(request('q') || request('tipe'))
                <div class="mb-8 text-gray-600 bg-white px-6 py-4 rounded-xl shadow-sm border border-gray-100 inline-block">
                    <span class="text-gray-400 mr-2"><i class='bx bx-filter-alt'></i></span>
                    Menampilkan hasil untuk:
                    @if(request('q')) <span class="font-semibold text-gray-900">"{{ request('q') }}"</span> @endif
                    @if(request('q') && request('tipe')) &bull; @endif
                    @if(request('tipe')) <span class="font-semibold text-gray-900">Tipe:
                    {{ ucfirst(request('tipe')) }}</span> @endif
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles ?? [] as $article)
                    <div
                        class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full transform hover:-translate-y-1">
                        @php
                            $articleImageMap = [
                                'edukasi' => 'artikel-edukasi.jpg',
                                'berita' => 'artikel-berita.jpg',
                                'default' => 'artikel-default.jpg',
                            ];
                            $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
                        @endphp

                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $article->photo ? asset('storage/' . $article->photo) : asset('img/' . $localImagePath) }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">

                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                    {{ $article->type }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <i class='bx bx-calendar'></i>
                                {{ $article->created_at->format('d M Y') }}
                            </div>

                            <h3
                                class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors leading-tight">
                                {{ $article->title }}
                            </h3>

                            <p class="text-gray-500 text-sm line-clamp-3 mb-6 leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                                <a href="{{ route('artikel.detail', $article->id) }}"
                                    class="text-blue-600 font-semibold text-sm hover:text-blue-700 flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Baca Selengkapnya
                                    <i class='bx bx-right-arrow-alt'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-16 text-center bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <i class='bx bx-news text-3xl text-blue-400'></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada artikel</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-6 text-sm">
                            Kami belum mempublikasikan artikel untuk saat ini. Silakan kembali lagi nanti.
                        </p>
                        @if(request('q') || request('tipe'))
                            <a href="{{ route('artikel.index') }}"
                                class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-medium shadow-lg shadow-blue-500/30 text-sm">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $articles->links('vendor.pagination.modern') }}
            </div>
        </div>
    </div>
</x-app-layout>