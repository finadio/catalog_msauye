<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Tambah UMKM Baru') }} {{-- Updated title for context --}}
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto"> {{-- Max-width added here to prevent form from being too wide --}}
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8"> {{-- Added frame and shadow --}}
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Form Penambahan UMKM</h3>

            <form method="POST" action="{{ route('admin.umkm.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Bagian Informasi Akun Pengguna UMKM --}}
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Informasi Akun UMKM</h4>
                    <div>
                        <label for="user_name" class="block mb-1 font-semibold text-gray-700">Nama Pengguna (untuk login)</label>
                        <input type="text" id="user_name" name="user_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('user_name') }}" required>
                        @error('user_name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="user_email" class="block mb-1 font-semibold text-gray-700">Email Pengguna (untuk login)</label>
                        <input type="email" id="user_email" name="user_email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('user_email') }}" required>
                        @error('user_email')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="user_password" class="block mb-1 font-semibold text-gray-700">Password</label>
                        <input type="password" id="user_password" name="user_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        @error('user_password')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="user_password_confirmation" class="block mb-1 font-semibold text-gray-700">Konfirmasi Password</label>
                        <input type="password" id="user_password_confirmation" name="user_password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>

                {{-- Bagian Informasi Detail UMKM --}}
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Informasi Detail UMKM</h4>
                    <div>
                        <label for="name" class="block mb-1 font-semibold text-gray-700">Nama UMKM</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name') }}" required>
                        @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="description" class="block mb-1 font-semibold text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description') }}</textarea>
                        @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="address" class="block mb-1 font-semibold text-gray-700">Alamat</label>
                        <input type="text" id="address" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('address') }}" required>
                        @error('address')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="phone" class="block mb-1 font-semibold text-gray-700">Telepon</label>
                        <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('phone') }}" required>
                        @error('phone')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="whatsapp" class="block mb-1 font-semibold text-gray-700">WhatsApp (opsional, diawali 62)</label>
                        <input type="text" id="whatsapp" name="whatsapp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('whatsapp') }}">
                        @error('whatsapp')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="instagram" class="block mb-1 font-semibold text-gray-700">Instagram (opsional)</label>
                        <input type="text" id="instagram" name="instagram" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('instagram') }}">
                        @error('instagram')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="photo" class="block mb-1 font-semibold text-gray-700">Foto UMKM (opsional)</label>
                        <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('photo')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.umkm.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition ease-in-out duration-150 font-semibold shadow-sm">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-md">Simpan UMKM</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>