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
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block mb-1 font-semibold text-gray-700">Nama Produk</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name', $product->name) }}" required>
                    @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="description" class="block mb-1 font-semibold text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="umkm_id" class="block mb-1 font-semibold text-gray-700">Pilih UMKM</label>
                    <select id="umkm_id" name="umkm_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih UMKM --</option>
                        {{-- Asumsi Anda memiliki variabel $umkms yang dikirim dari controller --}}
                        @foreach(App\Models\Umkm::all() as $umkmItem) {{-- Anda mungkin perlu mengirim $umkms dari controller --}}
                            <option value="{{ $umkmItem->id }}" @selected(old('umkm_id', $product->umkm_id) == $umkmItem->id)>{{ $umkmItem->name }}</option>
                        @endforeach
                    </select>
                    @error('umkm_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="category_id" class="block mb-1 font-semibold text-gray-700">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="price" class="block mb-1 font-semibold text-gray-700">Harga</label>
                    <input type="number" id="price" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('price', $product->price) }}" required>
                    @error('price')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="status_id" class="block mb-1 font-semibold text-gray-700">Status Produk</label>
                    <select id="status_id" name="status_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih Status --</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" @selected(old('status_id', $product->status_id) == $status->id)>{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="photo" class="block mb-1 font-semibold text-gray-700">Foto Produk (opsional)</label>
                    <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @if($product->photo)
                        {{-- Logika yang sama dengan show.blade.php untuk menampilkan foto --}}
                        @php
                            $photoPath = 'https://via.placeholder.com/80x60?text=Foto';
                            if ($product->photo) {
                                if (Illuminate\Support\Str::startsWith($product->photo, 'produk-dummy')) {
                                    $photoPath = asset('img/' . $product->photo);
                                } else if (Illuminate\Support\Str::startsWith($product->photo, 'products/')) {
                                    $photoPath = asset('storage/' . $product->photo);
                                } else if (Illuminate\Support\Str::startsWith($product->photo, 'produk/')) {
                                    $photoPath = asset('storage/' . $product->photo);
                                } else {
                                    $photoPath = asset('storage/' . $product->photo);
                                }
                            }
                        @endphp
                        <img src="{{ $photoPath }}" class="h-20 w-auto mt-2 rounded object-cover"/>
                        <div class="mt-2 flex items-center">
                            <input type="checkbox" name="remove_photo" id="remove_photo" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="remove_photo" class="ml-2 text-sm text-gray-600">Hapus foto saat ini</label>
                        </div>
                    @endif
                    @error('photo')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    {{-- PERBAIKAN DI SINI: Ubah 'admin.produk' menjadi 'admin.produk.index' --}}
                    <a href="{{ route('admin.produk.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition ease-in-out duration-150 font-semibold shadow-sm">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>