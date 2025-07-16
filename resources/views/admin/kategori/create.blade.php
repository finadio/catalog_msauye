<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Kategori</h2>
    </x-slot>
    <div class="py-8 max-w-xl mx-auto">
        <form method="POST" action="{{ route('admin.kategori.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label class="block mb-1 font-semibold">Nama Kategori</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('name') }}" required>
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan Kategori</button>
        </form>
    </div>
</x-app-layout> 