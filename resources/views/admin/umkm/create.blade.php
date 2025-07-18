<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Tambah UMKM Baru') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Form Penambahan UMKM</h3>

            <form method="POST" action="{{ route('admin.umkm.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Bagian Informasi Akun Pengguna UMKM --}}
                <div class="space-y-4 border-b border-gray-200 pb-6 mb-6">
                    <h4 class="text-lg font-semibold text-gray-800">Informasi Akun UMKM</h4>
                    <div>
                        <label for="user_name" class="block mb-1 font-semibold text-gray-700">Nama Pengguna (untuk login)</label>
                        <input type="text" id="user_name" name="user_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('user_name') }}" required>
                        @error('user_name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="user_email" class="block mb-1 font-semibold text-gray-700">Email Pengguna (untuk login)</label>
                        <input type="email" id="user_email" name="user_email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('user_email') }}" required>
                        @error('user_email')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    {{-- Password Field with Eye Icon --}}
                    <div x-data="{ showPassword: false }"> {{-- Alpine.js data --}}
                        <label for="user_password" class="block mb-1 font-semibold text-gray-700">Password</label>
                        <div class="relative"> {{-- Container untuk input dan icon --}}
                            <input
                                :type="showPassword ? 'text' : 'password'" {{-- Bind type attribute --}}
                                id="user_password"
                                name="user_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10" {{-- pr-10 untuk ruang ikon --}}
                                required
                            >
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                <i :class="showPassword ? 'bx bxs-hide' : 'bx bxs-show'"></i> {{-- Icon Show/Hide --}}
                            </button>
                        </div>
                        @error('user_password')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    {{-- Konfirmasi Password Field with Eye Icon --}}
                    <div x-data="{ showPassword: false }"> {{-- Alpine.js data --}}
                        <label for="user_password_confirmation" class="block mb-1 font-semibold text-gray-700">Konfirmasi Password</label>
                        <div class="relative"> {{-- Container untuk input dan icon --}}
                            <input
                                :type="showPassword ? 'text' : 'password'" {{-- Bind type attribute --}}
                                id="user_password_confirmation"
                                name="user_password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10" {{-- pr-10 untuk ruang ikon --}}
                                required
                            >
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                <i :class="showPassword ? 'bx bxs-hide' : 'bx bxs-show'"></i> {{-- Icon Show/Hide --}}
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Bagian Informasi Dasar UMKM --}}
                <div class="space-y-4 pb-6 mb-6">
                    <h4 class="text-lg font-semibold text-gray-800">Informasi Dasar UMKM</h4>
                    <div>
                        <label for="name" class="block mb-1 font-semibold text-gray-700">Nama UMKM</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name') }}" required>
                        @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="description" class="block mb-1 font-semibold text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description') }}</textarea>
                        @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="address" class="block mb-1 font-semibold text-gray-700">Alamat</label>
                        <input type="text" id="address" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('address') }}" required>
                        @error('address')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="photo" class="block mb-1 font-semibold text-gray-700">Foto UMKM (opsional)</label>
                        <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('photo')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Bagian Informasi Kontak dan Media Sosial --}}
                <div class="space-y-4 pb-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Kontak & Media Sosial</h4>
                    <div>
                        <label for="phone" class="block mb-1 font-semibold text-gray-700">Telepon</label>
                        <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('phone') }}" required>
                        @error('phone')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="whatsapp" class="block mb-1 font-semibold text-gray-700">WhatsApp (opsional, diawali 62)</label>
                        <input type="text" id="whatsapp" name="whatsapp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('whatsapp') }}">
                        @error('whatsapp')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="instagram" class="block mb-1 font-semibold text-gray-700">Instagram (opsional)</label>
                        <input type="text" id="instagram" name="instagram" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('instagram') }}">
                        @error('instagram')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    {{-- Field TikTok --}}
                    <div>
                        <label for="tiktok" class="block mb-1 font-semibold text-gray-700">TikTok (opsional)</label>
                        <input type="text" id="tiktok" name="tiktok" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('tiktok') }}">
                        @error('tiktok')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                    </div>
                    {{-- Field Website --}}
                    <div>
                        <label for="website" class="block mb-1 font-semibold text-gray-700">Website (opsional)</label>
                        <input type="url" id="website" name="website" placeholder="https://example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('website') }}">
                        @error('website')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
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