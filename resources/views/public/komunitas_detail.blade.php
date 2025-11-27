<x-app-layout>
    <div class="pt-52 pb-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb / Title -->
            <div class="mb-8">
                <a href="{{ route('komunitas') }}"
                    class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium mb-4 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Komunitas
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detail Komunitas</h1>
            </div>

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">

                <!-- Banner Image -->
                <div class="h-64 md:h-96 w-full relative bg-gray-200">
                    <img src="{{ asset($community->image) }}" alt="{{ $community->name }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="p-6 md:p-8">
                    <!-- Header Info -->
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <!-- Logo -->
                            <div class="w-16 h-16 rounded-full bg-white shadow-md p-1 flex-shrink-0">
                                <img src="{{ asset($community->logo) }}" alt="Logo"
                                    class="w-full h-full object-contain rounded-full">
                            </div>

                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h2 class="text-2xl font-bold text-gray-900">{{ $community->name }}</h2>
                                    <span
                                        class="px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-600 rounded border border-gray-200">{{ $community->type }}</span>
                                </div>
                                <p class="text-gray-500 text-sm mt-1">
                                    {{ $community->location }} • {{ $community->members_count }} anggota
                                </p>
                            </div>
                        </div>

                        @auth
                            @php
                                $memberStatus = null;
                                // Check if user is already a member
                                $currentUserMember = $community->members->where('user_id', auth()->id())->first();
                                if ($currentUserMember) {
                                    $memberStatus = $currentUserMember->status;
                                }
                            @endphp

                            @if($memberStatus === 'approved')
                                <button disabled
                                    class="w-full md:w-auto px-6 py-2.5 bg-green-600 text-white font-medium rounded-lg shadow-sm cursor-default opacity-80">
                                    Sudah Bergabung
                                </button>
                            @elseif($memberStatus === 'pending')
                                <button disabled
                                    class="w-full md:w-auto px-6 py-2.5 bg-yellow-500 text-white font-medium rounded-lg shadow-sm cursor-default opacity-80">
                                    Menunggu Persetujuan
                                </button>
                            @else
                                <form action="{{ route('komunitas.join', $community->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="w-full md:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                                        Gabung Komunitas
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full md:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-sm text-center inline-block">
                                Masuk untuk Bergabung
                            </a>
                        @endauth
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none text-gray-600 mb-8 whitespace-pre-line">
                        {{ $community->description }}
                    </div>

                    <!-- Link Box -->
                    @if($community->link)
                        <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4 mb-10 flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <a href="http://{{ $community->link }}" target="_blank"
                                class="text-yellow-700 hover:text-yellow-800 font-medium hover:underline">
                                {{ $community->link }}
                            </a>
                        </div>
                    @endif

                    <!-- Members Section -->
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-900">Anggota Komunitas</h3>
                            <button type="button" onclick="alert('Fitur daftar anggota lengkap akan segera hadir!')"
                                class="text-blue-600 hover:text-blue-700 text-sm font-medium bg-transparent border-0 cursor-pointer">Lihat
                                semua ({{ $community->members_count }})</button>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach($community->members as $member)
                                <div
                                    class="border border-gray-100 rounded-lg p-3 flex flex-col items-center text-center hover:shadow-md transition-shadow bg-white">
                                    <img src="{{ $member->user->photo ? asset('storage/' . $member->user->photo) : asset('img/umkm-default.png') }}"
                                        alt="{{ $member->user->name }}"
                                        class="w-12 h-12 rounded-full mb-2 bg-gray-100 object-cover">
                                    <h4 class="text-sm font-bold text-gray-900 truncate w-full">{{ $member->user->name }}
                                    </h4>
                                    <p class="text-xs text-gray-500 truncate w-full mb-2">{{ $member->role }}</p>
                                    <span
                                        class="px-2 py-0.5 text-[10px] font-medium bg-gray-100 text-gray-600 rounded-full">
                                        Member
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Discussion Section -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Diskusi & Pengumuman</h3>
                        <div class="text-gray-500 text-sm">
                            Belum ada diskusi/pengumuman.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>