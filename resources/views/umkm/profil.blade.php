<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Profil UMKM</h2>
    </x-slot>
    <div class="py-8 max-w-xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('umkm.profil') }}" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label class="block mb-1 font-semibold">Nama UMKM</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('name', $umkm->name) }}" required>
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded focus:outline-none" required>{{ old('description', $umkm->description) }}</textarea>
                @error('description')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Alamat</label>
                <input type="text" name="address" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('address', $umkm->address) }}" required>
                @error('address')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Telepon</label>
                <input type="text" name="phone" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('phone', $umkm->phone) }}" required>
                @error('phone')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">WhatsApp</label>
                <input type="text" name="whatsapp" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('whatsapp', $umkm->whatsapp) }}">
                @error('whatsapp')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Instagram</label>
                <input type="text" name="instagram" class="w-full px-4 py-2 border rounded focus:outline-none" value="{{ old('instagram', $umkm->instagram) }}">
                @error('instagram')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Foto UMKM</label>
                <input type="file" name="photo" class="w-full px-4 py-2 border rounded focus:outline-none">
                @if($umkm->photo)
                    <img src="{{ asset('storage/'.$umkm->photo) }}" class="h-20 mt-2 rounded"/>
                @endif
                @error('photo')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan Perubahan</button>
        </form>
    </div>
</x-app-layout> 