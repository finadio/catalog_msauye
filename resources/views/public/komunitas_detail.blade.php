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
                    <img src="{{ Str::startsWith($community->image, 'http') ? $community->image : asset($community->image) }}" alt="{{ $community->name }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="p-6 md:p-8">
                    <!-- Header Info -->
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <!-- Logo -->
                            <div class="w-16 h-16 rounded-full bg-white shadow-md p-1 flex-shrink-0">
                                <img src="{{ Str::startsWith($community->logo, 'http') ? $community->logo : asset($community->logo) }}" alt="Logo"
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
                                @php
                                    $photo = $member->user->photo;
                                    if (!$photo && $member->user->umkm) {
                                        $photo = $member->user->umkm->photo;
                                    }
                                    
                                    $photoUrl = asset('img/umkm-default.png');
                                    if ($photo) {
                                        if (Str::startsWith($photo, 'http')) {
                                            $photoUrl = $photo;
                                        } elseif (Str::startsWith($photo, 'img/')) {
                                             $photoUrl = asset($photo);
                                        } else {
                                            $photoUrl = asset('storage/' . $photo);
                                        }
                                    }
                                @endphp
                                <div
                                    class="border border-gray-100 rounded-lg p-3 flex flex-col items-center text-center hover:shadow-md transition-shadow bg-white">
                                    <img src="{{ $photoUrl }}"
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
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Diskusi & Pengumuman</h3>
                            @auth
                                @if($memberStatus === 'approved')
                                    <button onclick="document.getElementById('createPostModal').classList.remove('hidden')" 
                                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                        Buat Diskusi Baru
                                    </button>
                                @endif
                            @endauth
                        </div>

                        @php
                            $posts = \App\Models\CommunityPost::where('community_id', $community->id)
                                ->with(['user', 'comments.user'])
                                ->orderBy('is_pinned', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp

                        @if($posts->count() > 0)
                            <div class="space-y-6">
                                @foreach($posts as $post)
                                    <div class="bg-white border border-gray-200 rounded-xl p-6 {{ $post->is_pinned ? 'border-l-4 border-l-blue-500' : '' }}">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $posterPhoto = $post->user->photo;
                                                    if (!$posterPhoto && $post->user->umkm) {
                                                        $posterPhoto = $post->user->umkm->photo;
                                                    }
                                                    $posterPhotoUrl = asset('img/umkm-default.png');
                                                    if ($posterPhoto) {
                                                        if (Str::startsWith($posterPhoto, 'http')) {
                                                            $posterPhotoUrl = $posterPhoto;
                                                        } elseif (Str::startsWith($posterPhoto, 'img/')) {
                                                            $posterPhotoUrl = asset($posterPhoto);
                                                        } else {
                                                            $posterPhotoUrl = asset('storage/' . $posterPhoto);
                                                        }
                                                    }
                                                @endphp
                                                <img src="{{ $posterPhotoUrl }}"
                                                    alt="{{ $post->user->name }}"
                                                    class="w-10 h-10 rounded-full object-cover">
                                                <div>
                                                    <h4 class="font-bold text-gray-900">{{ $post->user->name }}</h4>
                                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            @if($post->is_pinned)
                                                <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs font-medium rounded-full flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                                                    Pinned
                                                </span>
                                            @endif
                                        </div>

                                        <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $post->title }}</h4>
                                        <p class="text-gray-700 mb-4 whitespace-pre-line">{{ $post->content }}</p>

                                        <!-- Comments Section -->
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <h5 class="text-sm font-bold text-gray-700 mb-3">Komentar ({{ $post->comments->count() }})</h5>
                                            
                                            <div class="space-y-3 mb-4">
                                                @foreach($post->comments as $comment)
                                                    <div class="flex gap-3">
                                                        @php
                                                            $commenterPhoto = $comment->user->photo;
                                                            if (!$commenterPhoto && $comment->user->umkm) {
                                                                $commenterPhoto = $comment->user->umkm->photo;
                                                            }
                                                            $commenterPhotoUrl = asset('img/umkm-default.png');
                                                            if ($commenterPhoto) {
                                                                if (Str::startsWith($commenterPhoto, 'http')) {
                                                                    $commenterPhotoUrl = $commenterPhoto;
                                                                } elseif (Str::startsWith($commenterPhoto, 'img/')) {
                                                                    $commenterPhotoUrl = asset($commenterPhoto);
                                                                } else {
                                                                    $commenterPhotoUrl = asset('storage/' . $commenterPhoto);
                                                                }
                                                            }
                                                        @endphp
                                                        <img src="{{ $commenterPhotoUrl }}"
                                                            class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                                                        <div class="bg-white p-3 rounded-lg border border-gray-200 flex-1">
                                                            <div class="flex justify-between items-start mb-1">
                                                                <span class="font-semibold text-sm text-gray-900">{{ $comment->user->name }}</span>
                                                                <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="text-sm text-gray-600">{{ $comment->content }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            @auth
                                                @if($memberStatus === 'approved')
                                                    <form action="{{ route('communities.comments.store', $post->id) }}" method="POST" class="flex gap-2">
                                                        @csrf
                                                        <input type="text" name="content" placeholder="Tulis komentar..." required
                                                            class="flex-1 rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                                                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-900">
                                                            Kirim
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                <p class="text-gray-500">Belum ada diskusi. Jadilah yang pertama memulai!</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Create Post Modal -->
    <div id="createPostModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('createPostModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('communities.posts.store', $community->id) }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Buat Diskusi Baru</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Judul Diskusi</label>
                                <input type="text" name="title" id="title" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Isi Diskusi</label>
                                <textarea name="content" id="content" rows="4" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Posting
                        </button>
                        <button type="button" onclick="document.getElementById('createPostModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>