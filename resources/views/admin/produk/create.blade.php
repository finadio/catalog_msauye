<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Form Penambahan Produk</h3>

            <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block mb-1 font-semibold text-gray-700">Nama Produk</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name') }}" required>
                    @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="description" class="block mb-1 font-semibold text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description') }}</textarea>
                    @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="umkm_id" class="block mb-1 font-semibold text-gray-700">Pilih UMKM</label>
                    <select id="umkm_id" name="umkm_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih UMKM --</option>
                        @foreach($umkms as $umkm)
                            <option value="{{ $umkm->id }}" @selected(old('umkm_id') == $umkm->id)>{{ $umkm->name }}</option>
                        @endforeach
                    </select>
                    @error('umkm_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="category_id" class="block mb-1 font-semibold text-gray-700">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="price" class="block mb-1 font-semibold text-gray-700">Harga</label>
                    <input type="number" id="price" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('price') }}" required>
                    @error('price')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="status_id" class="block mb-1 font-semibold text-gray-700">Status Produk</label>
                    <select id="status_id" name="status_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih Status --</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" @selected(old('status_id') == $status->id)>{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="photo" class="block mb-1 font-semibold text-gray-700">Foto Produk</label>
                    <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    @error('photo')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    {{-- PERBAIKAN DI SINI: Ubah 'admin.produk' menjadi 'admin.produk.index' --}}
                    <a href="{{ route('admin.produk.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition ease-in-out duration-150 font-semibold shadow-sm">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-md">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>