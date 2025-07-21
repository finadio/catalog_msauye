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
                <a href="{{ route('admin.umkm.create') }}" class="h-10 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto text-center inline-flex items-center justify-center">Tambah UMKM Baru</a>
            </div>

            {{-- Filter Form --}}
            <form method="GET" class="mb-6 flex flex-col sm:flex-row flex-wrap items-center gap-3">
                <div class="relative w-full sm:flex-1">
                    <input
                        x-model="q"
                        type="text"
                        name="q"
                        placeholder="Cari UMKM berdasarkan nama, deskripsi, alamat, telepon, dll..."
                        class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 w-full pr-12"
                    >
                    <button
                        x-show="q.length > 0"
                        @click.prevent="
                            q = '';
                            $event.target.closest('form').submit();
                        "
                        type="button"
                        class="absolute inset-y-0 right-0 w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-600 focus:outline-none z-20"
                        aria-label="Clear search"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Category Filter --}}
                <select x-model="kategori" name="kategori" class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 w-full sm:w-56">
                    <option value="">Semua Kategori Produk</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('kategori') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="h-10 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto">Filter</button>

                @if(request('q') || request('kategori'))
                    <a href="{{ route('admin.umkm.index') }}" class="w-full sm:w-auto px-8 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 font-semibold text-lg transition duration-300 ease-in-out shadow-md transform hover:-translate-y-0.5 text-center">Reset Filter</a>
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
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
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
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-lg">
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