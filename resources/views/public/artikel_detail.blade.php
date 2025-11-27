<x-app-layout>
    {{-- Hero Section with Background Image --}}
    @php
        $articleImageMap = [
            'edukasi' => 'artikel-edukasi.jpg',
            'berita' => 'artikel-berita.jpg',
            'default' => 'artikel-default.jpg',
        ];
        $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
        $imageUrl = $article->photo ? (Str::startsWith($article->photo, 'http') ? $article->photo : asset('storage/' . $article->photo)) : asset('img/' . $localImagePath);
    @endphp

    <div class="relative h-[60vh] min-h-[500px] bg-gray-900 overflow-hidden">
        {{-- Background Image with Overlay --}}
        <div class="absolute inset-0">
            <img src="{{ $imageUrl }}" alt="{{ $article->title }}" class="w-full h-full object-cover opacity-60">
            {{-- Gradient Overlay: Top (for Navbar) and Bottom (for Text) --}}
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/80 via-transparent to-[#0B1120]"></div>
        </div>

        {{-- Content --}}
        <div class="absolute bottom-0 left-0 right-0 pb-20 pt-32">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3 mb-6">
                    <span
                        class="px-3 py-1 bg-blue-600 text-white text-xs font-bold uppercase tracking-wider rounded-lg shadow-lg">
                        {{ $article->type }}
                    </span>
                    <span class="text-gray-300 text-sm font-medium flex items-center gap-2">
                        <i class='bx bx-calendar'></i>
                        {{ $article->created_at->format('d F Y') }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4 drop-shadow-lg">
                    {{ $article->title }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Article Content --}}
    <div class="bg-gray-50 min-h-screen pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
                {{-- Breadcrumb --}}
                <nav class="flex mb-8 text-sm font-medium text-gray-500 border-b border-gray-100 pb-6">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Beranda</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('artikel.index') }}" class="hover:text-blue-600 transition-colors">Artikel</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900 truncate max-w-[200px]">{{ $article->title }}</span>
                </nav>

                {{-- Main Content --}}
                <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed">
                    {!! $article->content !!}
                </div>

                {{-- Share & Navigation --}}
                <div
                    class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-semibold text-gray-900">Bagikan:</span>
                        <div class="flex gap-2">
                            <a href="#"
                                class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                                <i class='bx bxl-facebook'></i>
                            </a>
                            <a href="#"
                                class="w-8 h-8 rounded-full bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all">
                                <i class='bx bxl-whatsapp'></i>
                            </a>
                            <a href="#"
                                class="w-8 h-8 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center hover:bg-sky-600 hover:text-white transition-all">
                                <i class='bx bxl-twitter'></i>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('artikel.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                        <i class='bx bx-arrow-back'></i>
                        Kembali ke Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>