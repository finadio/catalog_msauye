<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">{{ $article->title ?? 'Detail Artikel' }}</h1>
    </x-slot>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8">
            <img src="{{ $article->photo ?? 'https://via.placeholder.com/600x300?text=Foto+Artikel' }}" alt="{{ $article->title }}" class="rounded-lg w-full object-cover h-64 mb-6">
            <div class="mb-2 text-gray-500 capitalize">{{ $article->type }}</div>
            <div class="prose max-w-none">{!! $article->content ?? '' !!}</div>
        </div>
    </div>
</x-app-layout> 