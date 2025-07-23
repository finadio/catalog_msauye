<x-app-layout>
    <div class="pt-20 pb-10 min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 backdrop-blur-sm">

                {{-- Header dengan Gradient --}}
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Tambah Produk Baru</h1>
                            <p class="text-blue-100 text-sm">Lengkapi informasi produk Anda dengan detail</p>
                        </div>
                        <a href="{{ route('umkm_produk') }}" class="px-6 py-3 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl shadow-lg backdrop-blur-sm transition-all duration-300 hover:scale-105">
                            ← Kembali
                        </a>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('umkm_produkstore') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        {{-- Informasi Produk dengan Card Style --}}
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                            <div class="flex items-center mb-6">
                                <div class="w-3 h-8 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-full mr-4"></div>
                                <h2 class="text-2xl font-bold text-gray-800">Informasi Produk</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="lg:col-span-2">
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                        Nama Produk
                                    </label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" 
                                           class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 px-4 py-3 text-gray-700 hover:border-blue-300" 
                                           placeholder="Masukkan nama produk Anda" required>
                                </div>

                                <div class="lg:col-span-2">
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                        Deskripsi Produk
                                    </label>
                                    <textarea name="deskripsi" rows="4" 
                                              class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 px-4 py-3 text-gray-700 hover:border-blue-300" 
                                              placeholder="Ceritakan tentang produk Anda...">{{ old('deskripsi') }}</textarea>
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Harga (opsional)
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                        <input type="number" name="harga" value="{{ old('harga') }}" 
                                               class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 pl-12 pr-4 py-3 text-gray-700 hover:border-blue-300" 
                                               placeholder="0">
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                                        Kategori Produk
                                    </label>
                                    <select name="category_id" 
                                            class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 px-4 py-3 text-gray-700 hover:border-blue-300" required>
                                        <option value="" disabled selected>🏷️ Pilih Kategori Produk</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="lg:col-span-2">
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                                        Foto Produk
                                    </label>
                                    <div class="relative">
                                        <input type="file" name="foto" accept="image/*" 
                                               class="w-full rounded-xl border-2 border-dashed border-gray-300 hover:border-blue-400 transition-all duration-300 px-4 py-6 text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        <div class="absolute top-2 right-4 text-gray-400 text-sm">
                                            📸 JPG, PNG, atau JPEG
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kontak & Sosial Media dengan Card Style --}}
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-100">
                            <div class="flex items-center mb-6">
                                <div class="w-3 h-8 bg-gradient-to-b from-emerald-500 to-teal-600 rounded-full mr-4"></div>
                                <h2 class="text-2xl font-bold text-gray-800">Kontak & Sosial Media</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="text-green-500 mr-2">📱</span>
                                        Nomor WhatsApp
                                    </label>
                                    <input type="text" name="wa" value="{{ old('wa') }}" 
                                           placeholder="08xxxxxxxxxx" 
                                           class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 px-4 py-3 text-gray-700 hover:border-emerald-300">
                                </div>
                                
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="text-pink-500 mr-2">📷</span>
                                        Instagram
                                    </label>
                                    <input type="text" name="instagram" value="{{ old('instagram') }}" 
                                           placeholder="@username" 
                                           class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 px-4 py-3 text-gray-700 hover:border-emerald-300">
                                </div>
                                
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="text-black mr-2">🎵</span>
                                        TikTok
                                    </label>
                                    <input type="text" name="tiktok" value="{{ old('tiktok') }}" 
                                           placeholder="@tiktokshop" 
                                           class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 px-4 py-3 text-gray-700 hover:border-emerald-300">
                                </div>
                                
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                                        <span class="text-blue-500 mr-2">🌐</span>
                                        Website
                                    </label>
                                    <input type="text" name="website" value="{{ old('website') }}" 
                                           placeholder="https://example.com" 
                                           class="w-full rounded-xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 px-4 py-3 text-gray-700 hover:border-emerald-300">
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Submit dengan Style Menarik --}}
                        <div class="flex justify-center pt-6">
                            <button type="submit" 
                                    class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transform transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                                <span class="relative z-10 flex items-center">
                                    💾 Simpan Produk
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-2xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>