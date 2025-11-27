<x-app-layout>
    {{-- Hero Section --}}
    <div class="relative bg-slate-900 pt-40 pb-20 lg:pt-52 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('img/msa1.jpeg') }}" class="w-full h-full object-cover" alt="Background">
            <div class="absolute inset-0 bg-slate-900 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
                Komunitas UMKM <br class="hidden md:inline"><span class="text-blue-400">BPR MSA</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
                Temukan dan bergabung dengan komunitas yang tepat untuk mengembangkan bisnis Anda.
            </p>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="bg-gray-50 py-12 lg:py-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search & Filter Section --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-10 border border-gray-100">
                <form action="" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-search text-gray-400 text-xl'></i>
                            </div>
                            <input type="text" name="q"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                                placeholder="Cari komunitas / kota / deskripsi...">
                        </div>
                    </div>
                    <div class="md:col-span-5">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-category text-gray-400 text-xl'></i>
                            </div>
                            <select name="category"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out text-gray-600">
                                <option value="">Semua Kategori</option>
                                <option value="umkm">UMKM</option>
                                <option value="peternakan">Peternakan</option>
                                <option value="kerajinan">Kerajinan</option>
                            </select>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit"
                            class="w-full flex justify-center items-center px-4 py-3 border border-transparent text-sm font-bold rounded-lg text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition duration-150 ease-in-out shadow-lg">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            {{-- Community Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($communities as $community)
                    <a href="{{ route('komunitas.detail', $community->id) }}"
                        class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col h-full group">
                        {{-- Banner Image --}}
                        <div class="h-40 bg-gray-200 relative">
                            <img src="{{ asset($community->image) }}" alt="{{ $community->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        {{-- Content --}}
                        <div class="p-6 pt-0 flex-grow flex flex-col relative">
                            {{-- Logo (Floating) --}}
                            <div class="flex justify-start -mt-10 mb-4">
                                <div
                                    class="w-20 h-20 rounded-full border-4 border-white bg-white shadow-md overflow-hidden z-10">
                                    <img src="{{ asset($community->logo) }}" alt="Logo"
                                        class="w-full h-full object-contain p-1">
                                </div>
                            </div>

                            {{-- Title & Location --}}
                            <div class="mb-4">
                                <h3
                                    class="text-xl font-bold text-gray-900 leading-tight mb-1 group-hover:text-blue-600 transition-colors">
                                    {{ $community->name }}</h3>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class='bx bx-map mr-1'></i> {{ $community->location }}
                                </p>
                            </div>

                            {{-- Description --}}
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3 flex-grow">
                                {{ $community->description }}
                            </p>

                            {{-- Tags --}}
                            <div class="flex flex-wrap gap-2 mt-auto">
                                @foreach($community->tags as $tag)
                                    @php
                                        $badgeColor = 'bg-gray-100 text-gray-600';
                                        if (str_contains(strtolower($tag), 'publik'))
                                            $badgeColor = 'bg-green-100 text-green-700';
                                        if (str_contains(strtolower($tag), 'anggota'))
                                            $badgeColor = 'bg-blue-100 text-blue-700';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium {{ $badgeColor }}">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Empty State (If needed) --}}
            @if(count($communities) == 0)
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class='bx bx-search text-3xl text-gray-400'></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Tidak ada komunitas ditemukan</h3>
                    <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter Anda.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>