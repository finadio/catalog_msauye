<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Artikel & Edukasi</h1>
    </x-slot>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($articles ?? [] as $article)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        <img src="{{ $article->photo ?? 'https://via.placeholder.com/600x300?text=Foto+Artikel' }}" alt="{{ $article->title }}" class="h-48 w-full object-cover">
                        <div class="p-4 flex-1 flex flex-col">
                            <h2 class="font-semibold text-lg mb-1">{{ $article->title }}</h2>
                            <div class="text-gray-500 text-sm mb-2 capitalize">{{ $article->type }}</div>
                            <div class="text-gray-700 mb-2">{{ Str::limit(strip_tags($article->content), 100) }}</div>
                            <a href="{{ route('artikel.detail', $article->id) }}" class="mt-auto inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Baca Selengkapnya</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-500 py-12">Belum ada artikel.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 