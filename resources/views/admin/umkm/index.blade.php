<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Kelola UMKM') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ q: '{{ request('q') }}', kategori: '{{ request('kategori') }}' }">
        {{-- Notifikasi Sukses dengan Tombol Close --}}
        <x-success-notification :message="session('success')" />

        {{-- Main white box/frame --}}
        <div class="bg-white shadow-lg rounded-xl p-6">

            {{-- Header section for the main box: Title and Add New UMKM Button --}}
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
                <h3 class="text-2xl font-bold text-gray-900">Daftar UMKM</h3>
                <a href="{{ route('admin.umkm.create') }}" class="h-10 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto text-center inline-flex items-center justify-center whitespace-nowrap">Tambah UMKM Baru</a>
            </div>

            {{-- Filter Form --}}
            <form method="GET" class="mb-6 flex flex-col sm:flex-row flex-wrap items-center gap-3">
                <div class="relative w-full sm:flex-1">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari UMKM..."
                        class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 w-full pr-12"
                    >
                    @if(request('q'))
                    <a href="?{{ http_build_query(array_merge(request()->except('q','page'), ['q'=>''])) }}" class="absolute inset-y-0 right-0 w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-600 focus:outline-none z-20" aria-label="Clear search">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                    @endif
                </div>
                
                {{-- Filter Status --}}
                <select name="status" class="h-10 pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 w-full sm:w-48 appearance-none">
                    <option value="">Semua Status</option>
                    <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                    <option value="approved" @selected(request('status') == 'approved')>Disetujui</option>
                    <option value="rejected" @selected(request('status') == 'rejected')>Ditolak</option>
                </select>
                
                {{-- Filter Kategori --}}
                <select name="kategori" class="h-10 pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 w-full sm:w-56 appearance-none">
                    <option value="">Semua Kategori Produk</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('kategori') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="h-10 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto whitespace-nowrap">Filter</button>
                @if(request('q') || request('kategori') || request('status'))
                    <a href="{{ route('admin.umkm.index') }}" class="w-full sm:w-auto px-6 py-2 h-10 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 font-semibold transition duration-300 ease-in-out shadow-md text-center inline-flex items-center justify-center whitespace-nowrap">Reset</a>
                @endif
            </form>

            {{-- UMKM List Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alamat</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Telepon</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($umkms as $umkm)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $umkm->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($umkm->description, 60) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $umkm->address }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $umkm->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                    @if($umkm->user->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Pending
                                        </span>
                                    @elseif($umkm->user->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Disetujui
                                        </span>
                                    @elseif($umkm->user->status === 'rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        @if($umkm->user->status === 'pending')
                                            <form method="POST" action="{{ route('admin.umkm.approve', $umkm->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.umkm.reject', $umkm->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="{{ route('admin.umkm.show', $umkm->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                                            Edit
                                        </a>
                                        <button
                                            type="button"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-umkm-deletion-{{ $umkm->id }}')"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            {{-- Delete Confirmation Modal --}}
                            <x-modal name="confirm-umkm-deletion-{{ $umkm->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="POST" action="{{ route('admin.umkm.destroy', $umkm->id) }}" class="p-6">
                                    @csrf
                                    @method('DELETE')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        Apakah Anda yakin ingin menghapus UMKM ini?
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        Data UMKM ini akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                                    </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            Batal
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            Hapus UMKM
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-lg">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada UMKM ditemukan</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Mulai tambahkan UMKM atau sesuaikan filter pencarian.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $umkms->links('vendor.pagination.modern') }}
            </div>
        </div>
    </div>
</x-app-layout>