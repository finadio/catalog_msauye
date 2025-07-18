<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Kelola UMKM') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main white box/frame --}}
        <div class="bg-white shadow-lg rounded-xl p-6">

            @if(session('success'))
                {{-- Notifikasi Sukses dengan Tombol Close (sama seperti di produk) --}}
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:opacity.duration.500ms
                    class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg font-medium shadow-sm relative pr-10"
                    role="alert"
                >
                    {{ session('success') }}
                    <button
                        type="button"
                        @click="show = false"
                        class="absolute top-1/2 -translate-y-1/2 right-3 text-green-700 hover:text-green-900 focus:outline-none"
                        aria-label="Close"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Header section for the main box: Title and Add New UMKM Button --}}
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
                <h3 class="text-2xl font-bold text-gray-900">Daftar UMKM</h3>
                {{-- Tombol Tambah UMKM Baru --}}
                <a href="{{ route('admin.umkm.create') }}" class="h-10 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto text-center inline-flex items-center justify-center">Tambah UMKM Baru</a>
            </div>

            {{-- Search Form (di dalam frame utama) --}}
            <form method="GET" class="mb-6 flex flex-col sm:flex-row gap-3 items-center">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari UMKM berdasarkan nama..." class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 w-full sm:flex-1"> {{-- Menggunakan sm:flex-1 untuk search bar --}}
                <button type="submit" class="h-10 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto">Cari</button>
            </form>

            {{-- UMKM List Table (di dalam frame utama) --}}
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
                {{ $umkms->links() }}
            </div>
        </div>
    </div>
</x-app-layout>