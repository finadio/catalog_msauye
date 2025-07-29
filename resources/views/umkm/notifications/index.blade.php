<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifikasi UMKM') }}
            </h2>
            @if($notifications->where('read_at', null)->count() > 0)
                <form method="POST" action="{{ route('umkm.notifications.read-all') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                        Tandai Semua Sudah Dibaca
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Search and Filter Section -->
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('umkm.notifications.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search Bar -->
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Notifikasi</label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari berdasarkan judul atau pesan..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                                </select>
                            </div>
                            
                            <!-- Type Filter -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                                <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Tipe</option>
                                    <option value="ProductStatusChanged" {{ request('type') === 'ProductStatusChanged' ? 'selected' : '' }}>Status Produk</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex space-x-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                <i class="fas fa-search mr-1"></i> Cari
                            </button>
                            <a href="{{ route('umkm.notifications.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                                <i class="fas fa-times mr-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>

                <div class="p-6 text-gray-900">
                    @if($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="border rounded-lg p-4 {{ $notification->read_at ? 'bg-gray-50' : 'bg-blue-50 border-blue-200' }}">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <i class="{{ $notification->data['icon'] ?? 'fas fa-bell' }} text-{{ $notification->data['color'] ?? 'blue' }}-500"></i>
                                                <h3 class="font-semibold text-lg {{ $notification->read_at ? 'text-gray-700' : 'text-gray-900' }}">
                                                    {{ $notification->data['title'] }}
                                                </h3>
                                                @if(!$notification->read_at)
                                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">Baru</span>
                                                @endif
                                            </div>
                                            <p class="text-gray-600 mt-2">{{ $notification->data['message'] }}</p>
                                            <p class="text-sm text-gray-500 mt-2">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="flex space-x-2 ml-4">
                                            @if(isset($notification->data['action_url']))
                                                <a href="{{ $notification->data['action_url'] }}" 
                                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Lihat
                                                </a>
                                            @endif
                                            @if(!$notification->read_at)
                                                <form method="POST" action="{{ route('umkm.notifications.read', $notification->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Tandai Dibaca
                                                    </button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('umkm.notifications.destroy', $notification->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm"
                                                        onclick="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-bell-slash text-gray-400 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-lg">Tidak ada notifikasi</p>
                        </div>
                    @endif

                    <!-- Pagination selalu ditampilkan -->
                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
