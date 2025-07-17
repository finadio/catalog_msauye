<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Profil UMKM</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <form method="POST" action="{{ route('profil') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama UMKM</label>
                        <input type="text" name="name" class="form-input w-full" value="{{ old('name', auth()->user()->name) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" class="form-textarea w-full">{{ old('description', auth()->user()->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                        <input type="file" name="photo" class="form-input w-full">
                    </div>

                    <div class="flex justify-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
