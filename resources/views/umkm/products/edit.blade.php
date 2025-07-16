<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk</h2>
    </x-slot>
    <div class="py-8 max-w-xl mx-auto">
        <form method="POST" action="{{ route('umkm.produk.update', $product->id) }}" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @method('PUT')
            <div>
                <label class="block mb-1 font-semibold">Nama Produk</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('name', $product->name) }}" required>
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded focus:outline-none" required>{{ old('description', $product->description) }}</textarea>
                @error('description')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Kategori</label>
                <select name="category_id" class="w-full px-4 py-2 border rounded focus:outline-none" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Harga</label>
                <input type="number" name="price" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('price', $product->price) }}" required>
                @error('price')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Foto Produk</label>
                <input type="file" name="photo" class="w-full px-4 py-2 border rounded focus:outline-none">
                @if($product->photo)
                    <img src="{{ asset('storage/'.$product->photo) }}" class="h-20 mt-2 rounded"/>
                @endif
                @error('photo')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Produk</button>
        </form>
    </div>
</x-app-layout> 