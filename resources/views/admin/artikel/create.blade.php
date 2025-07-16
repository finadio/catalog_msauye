<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Artikel</h2>
    </x-slot>
    <div class="py-8 max-w-xl mx-auto">
        <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label class="block mb-1 font-semibold">Judul</label>
                <input type="text" name="title" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('title') }}" required>
                @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Tipe</label>
                <select name="type" class="w-full px-4 py-2 border rounded focus:outline-none" required>
                    <option value="">Pilih Tipe</option>
                    <option value="edukasi" @selected(old('type')=='edukasi')>Edukasi</option>
                    <option value="berita" @selected(old('type')=='berita')>Berita</option>
                </select>
                @error('type')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Konten</label>
                <textarea name="content" rows="6" class="w-full px-4 py-2 border rounded focus:outline-none" required>{{ old('content') }}</textarea>
                @error('content')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Foto (opsional)</label>
                <input type="file" name="photo" class="w-full px-4 py-2 border rounded focus:outline-none">
                @error('photo')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan Artikel</button>
        </form>
    </div>
</x-app-layout> 