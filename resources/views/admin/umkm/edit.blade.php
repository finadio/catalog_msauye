<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Edit Data UMKM') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Form Edit Data UMKM</h3>

            <form method="POST" action="{{ route('admin.umkm.update', $umkm->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                {{-- Bagian Informasi Dasar UMKM --}}
                <div class="space-y-4 border-b border-gray-200 pb-6 mb-6">
                    <h4 class="text-lg font-semibold text-gray-800">Informasi Dasar UMKM</h4>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Nama UMKM</label>
                        <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name', $umkm->name) }}" required>
                        @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description', $umkm->description) }}</textarea>
                        @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Alamat</label>
                        <input type="text" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('address', $umkm->address) }}" required>
                        @error('address')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Foto UMKM (opsional)</label>
                        <input type="file" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @if($umkm->photo)
                            <img src="{{ asset('storage/'.$umkm->photo) }}" class="h-20 mt-2 rounded object-cover"/>
                        @endif
                        @error('photo')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Bagian Informasi Kontak dan Media Sosial --}}
                <div class="space-y-4 pb-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Kontak & Media Sosial</h4>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Telepon</label>
                        <input type="text" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('phone', $umkm->phone) }}" required>
                        @error('phone')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">WhatsApp (opsional, diawali 62)</label>
                        <input type="text" name="whatsapp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('whatsapp', $umkm->whatsapp) }}">
                        @error('whatsapp')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Instagram (opsional)</label>
                        <input type="text" name="instagram" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('instagram', $umkm->instagram) }}">
                        @error('instagram')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    {{-- Tambahan field TikTok --}}
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">TikTok (opsional)</label>
                        <input type="text" name="tiktok" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('tiktok', $umkm->tiktok) }}">
                        @error('tiktok')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    {{-- Tambahan field Website --}}
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Website (opsional)</label>
                        <input type="url" name="website" placeholder="https://example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('website', $umkm->website) }}">
                        @error('website')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.umkm.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition ease-in-out duration-150 font-semibold shadow-sm">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>