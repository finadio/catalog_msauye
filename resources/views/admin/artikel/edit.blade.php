<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Edit Artikel') }}
        </h2>
    </x-slot>
    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Form Edit Artikel</h3>

            <form method="POST" action="{{ route('admin.artikel.update', $article->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Judul</label>
                    <input type="text" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('title', $article->title) }}" required>
                    @error('title')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Tipe</label>
                    <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">Pilih Tipe</option>
                        <option value="edukasi" @selected(old('type', $article->type)=='edukasi')>Edukasi</option>
                        <option value="berita" @selected(old('type', $article->type)=='berita')>Berita</option>
                    </select>
                    @error('type')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Konten</label>
                    <textarea name="content" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('content', $article->content) }}</textarea>
                    @error('content')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Foto (opsional)</label>
                    <input type="file" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @if($article->photo)
                        <img src="{{ asset('storage/'.$article->photo) }}" class="h-20 mt-2 rounded"/>
                    @endif
                    @error('photo')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.artikel.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition ease-in-out duration-150 font-semibold shadow-sm">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>