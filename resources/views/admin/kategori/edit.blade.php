<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kategori</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Form Edit Kategori</h3>

            {{-- Menggunakan $kategori->id untuk action form --}}
            <form method="POST" action="{{ route('admin.kategori.update', $kategori->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block mb-1 font-semibold text-gray-700">Nama Kategori</label>
                    {{-- Menggunakan $kategori->name untuk value input --}}
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name', $kategori->name) }}" required>
                    @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.kategori.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition ease-in-out duration-150 font-semibold shadow-sm">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>