<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Detail Artikel</h1>
    </x-slot>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
            @php
                // Mengambil gambar berdasarkan tipe artikel, dengan fallback ke dummy jika tidak ditemukan
                $articleImageMap = [
                    'edukasi' => 'artikel-edukasi.jpg',
                    'berita' => 'artikel-berita.jpg',
                    'default' => 'artikel-default.jpg', // Fallback umum
                ];
                $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
            @endphp
            <img src="{{ $article->photo ? asset('storage/'.$article->photo) : asset('img/' . $localImagePath) }}" alt="{{ $article->title }}" class="rounded-lg w-full object-cover h-64 md:h-80 mb-8 shadow-md">
            <div class="mb-4 text-gray-600 text-sm">
                <span class="font-semibold">Tipe:</span> <span class="capitalize">{{ $article->type }}</span>
                <span class="mx-2">|</span>
                <span class="font-semibold">Tanggal:</span> {{ $article->created_at->format('d M Y') }}
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $article->title ?? 'Detail Artikel' }}</h2>
            <div class="prose max-w-none text-gray-800 leading-relaxed text-base">
                {!! $article->content ?? '' !!}
            </div>
            <div class="mt-8 text-right">
                <a href="{{ route('artikel.index') }}" class="inline-block px-6 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold transition duration-300">Kembali ke Artikel</a>
            </div>
        </div>
    </div>
</x-app-layout>