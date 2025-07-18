<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Edit Produk') }}
        </h2>
    </x-slot>
    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Form Edit Produk</h3>

            <form method="POST" action="{{ route('admin.produk.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Nama Produk</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name', $product->name) }}" required>
                    @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Harga</label>
                    {{-- Tambahkan placeholder di sini --}}
                    <input type="number" name="price" placeholder="Contoh: 15000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('price', $product->price) }}" required>
                    @error('price')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Status</label>
                    <select name="status_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        @foreach($statuses as $stat)
                            <option value="{{ $stat->id }}" @selected(old('status_id', $product->status_id) == $stat->id)>{{ $stat->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Foto Produk</label>
                    <input type="file" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @if($product->photo)
                        <img src="{{ asset('storage/'.$product->photo) }}" class="h-20 mt-2 rounded object-cover"/>
                    @endif
                    @error('photo')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.produk.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition ease-in-out duration-150 font-semibold shadow-sm">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>