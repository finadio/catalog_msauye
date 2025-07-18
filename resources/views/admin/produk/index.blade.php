<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ q: '{{ request('q') }}', kategori: '{{ request('kategori') }}', status: '{{ request('status') }}' }"> {{-- Tambahkan x-data untuk q, kategori, status --}}
        {{-- Notifikasi Sukses dengan Tombol Close --}}
        <x-success-notification :message="session('success')" />

        {{-- Main white box/frame --}}
        <div class="bg-white shadow-lg rounded-xl p-6">

            {{-- Header section for the main box: Title and Add New Product Button --}}
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
                <h3 class="text-2xl font-bold text-gray-900">Daftar Produk</h3>
                <a href="{{ route('admin.produk.create') }}" class="h-10 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto text-center inline-flex items-center justify-center">Tambah Produk Baru</a>
            </div>

            {{-- Filter Form --}}
            <form method="GET" class="mb-6 flex flex-col sm:flex-row flex-wrap items-center gap-3">
                <div class="relative w-full sm:flex-1"> {{-- Wrapper untuk input dan tombol clear --}}
                    <input
                        x-model="q" {{-- Gunakan x-model untuk mengikat nilai input --}}
                        type="text"
                        name="q"
                        placeholder="Cari produk..."
                        class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 w-full pr-12" {{-- pr-12 untuk ruang ikon --}}
                    >
                    <button
                        x-show="q.length > 0" {{-- Tampilkan tombol clear jika ada teks --}}
                        @click.prevent="q = ''; $event.target.closest('form').querySelector('input[name=\'q\']').value = ''; $event.target.closest('form').submit();" {{-- Logika bersih dan submit --}}
                        type="button"
                        class="absolute inset-y-0 right-0 w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-600 focus:outline-none z-20" {{-- z-index untuk clickability --}}
                        aria-label="Clear search"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Category Select --}}
                <select x-model="kategori" name="kategori" class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 w-full sm:w-56">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('kategori', request('kategori')) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>

                {{-- Status Select --}}
                <select x-model="status" name="status" class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 w-full sm:w-56">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $stat)
                        <option value="{{ $stat->id }}" @selected(old('status', request('status')) == $stat->id)>{{ $stat->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="h-10 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto">Filter</button>
            </form>

            {{-- Product List Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">UMKM</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($product->price,0,',','.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($product->status->name == 'approved') bg-green-100 text-green-800
                                        @elseif($product->status->name == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($product->status->name) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->umkm->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        @if($product->status->name == 'pending')
                                            <form action="{{ route('admin.produk.approve', $product->id) }}" method="POST" onsubmit="return confirm('Approve produk ini?')" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.produk.reject', $product->id) }}" method="POST" onsubmit="return confirm('Reject produk ini?')" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.produk.edit', $product->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                                            Edit
                                        </a>
                                        <button
                                            type="button"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion-{{ $product->id }}')"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            {{-- Delete Confirmation Modal --}}
                            <x-modal name="confirm-product-deletion-{{ $product->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="POST" action="{{ route('admin.produk.destroy', $product->id) }}" class="p-6">
                                    @csrf
                                    @method('DELETE')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        Apakah Anda yakin ingin menghapus Produk ini?
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        Data Produk ini akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                                    </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            Batal
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            Hapus Produk
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
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada produk ditemukan</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Coba sesuaikan filter pencarian.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>