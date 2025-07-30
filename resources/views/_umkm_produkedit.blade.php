<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4">
        <h2 class="text-2xl font-bold mb-6">Edit Produk</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-6 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('umkm_produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-semibold mb-1">Harga (opsional)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block font-semibold mb-1">Kategori</label>
                <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="location" class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="location" id="location" value="{{ old('location', $product->location) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-6">
                <label for="image" class="block font-semibold mb-1">Foto Produk (biarkan kosong jika tidak ingin ganti)</label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" class="h-32 rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('umkm_produk') }}" class="text-gray-600 hover:underline">← Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
