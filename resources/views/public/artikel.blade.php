<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Artikel & Edukasi</h1>
    </x-slot>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-10 text-center">Wawasan dan Inspirasi untuk UMKM</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                @forelse($articles ?? [] as $article)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden flex flex-col">
                        @php
                            // Mengambil gambar berdasarkan tipe artikel, dengan fallback ke dummy jika tidak ditemukan
                            $articleImageMap = [
                                'edukasi' => 'artikel-edukasi.jpg',
                                'berita' => 'artikel-berita.jpg',
                                'default' => 'artikel-default.jpg', // Fallback umum
                            ];
                            $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
                        @endphp
                        <img src="{{ $article->photo ? asset('storage/'.$article->photo) : asset('img/' . $localImagePath) }}" alt="{{ $article->title }}" class="w-full h-48 md:h-56 object-cover transform group-hover:scale-105 transition-transform duration-300">
                        <div class="p-6 flex-1 flex flex-col">
                            <span class="text-blue-600 text-sm font-semibold capitalize mb-2">{{ $article->type }}</span>
                            <h3 class="font-bold text-xl text-gray-900 leading-tight mb-3">{{ Str::limit($article->title, 70) }}</h3>
                            <p class="text-gray-700 text-sm md:text-base mb-4 flex-1 leading-relaxed">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                            <a href="{{ route('artikel.detail', $article->id) }}" class="text-blue-600 hover:underline font-semibold text-base flex items-center justify-end">Baca Selengkapnya <span class="ml-1">&rarr;</span></a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-12 text-lg">Belum ada artikel.</div>
                @endforelse
            </div>
            <div class="mt-12 flex justify-center">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>