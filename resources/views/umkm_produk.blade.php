<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">
        {{-- Header Section --}}
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <a href="{{ route('umkm_produk') }}" 
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if(isset($product))
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            @endif
                        </svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' }}
                    </h1>
                    <p class="text-gray-600 mt-1">
                        {{ isset($product) ? 'Perbarui informasi produk Anda' : 'Tambahkan produk baru ke toko Anda' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-sm">
                <div class="flex items-start p-4">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan dalam form:</h3>
                        <ul class="mt-2 text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center space-x-2">
                                    <span class="w-1 h-1 bg-red-400 rounded-full"></span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Form Card --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form method="POST"
                  action="{{ isset($product) ? route('umkm_produk.update', $product->id) : route('umkm_produk.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-0">
                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif

                {{-- Form Header --}}
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Produk</h3>
                    <p class="text-sm text-gray-600 mt-1">Lengkapi form di bawah dengan informasi produk yang akurat</p>
                </div>

                <div class="p-6 space-y-8">
                    {{-- Basic Information Section --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- Left Column --}}
                        <div class="space-y-6">
                            {{-- Nama Produk --}}
                            <div class="form-group">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span>Nama Produk</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama"
                                       value="{{ old('nama', $product->nama ?? '') }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors duration-200 placeholder-gray-400"
                                       placeholder="Masukkan nama produk yang menarik"
                                       required>
                            </div>

                            {{-- Kategori --}}
                            <div class="form-group">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <span>Kategori</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="kategori_id"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors duration-200 bg-white"
                                        required>
                                    <option value="" disabled selected>Pilih kategori produk</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('kategori_id', $product->kategori_id ?? '') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Harga --}}
                            <div class="form-group">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    <span>Harga</span>
                                    <span class="text-gray-400 text-xs">(opsional)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="harga"
                                           value="{{ old('harga', $product->harga ?? '') }}"
                                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors duration-200 placeholder-gray-400"
                                           placeholder="0">
                                </div>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="space-y-6">
                            {{-- Deskripsi --}}
                            <div class="form-group">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Deskripsi Produk</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                <textarea name="deskripsi" rows="6"
                                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors duration-200 placeholder-gray-400 resize-none"
                                          placeholder="Deskripsikan produk Anda secara detail..."
                                          required>{{ old('deskripsi', $product->deskripsi ?? '') }}</textarea>
                                <p class="text-xs text-gray-500 mt-2">Jelaskan fitur, manfaat, dan keunggulan produk Anda</p>
                            </div>
                        </div>
                    </div>

                    {{-- Photo Upload Section --}}
                    <div class="border-t border-gray-200 pt-8">
                        <div class="form-group">
                            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700 mb-4">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Foto Produk</span>
                            </label>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                {{-- Upload Area --}}
                                <div>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200 bg-gray-50">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="text-sm text-gray-600 mb-2">
                                            <label for="foto" class="cursor-pointer text-blue-600 hover:text-blue-500 font-medium">
                                                Klik untuk upload
                                            </label>
                                            atau drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                                        <input type="file" id="foto" name="foto" 
                                               class="hidden" 
                                               accept="image/png,image/jpg,image/jpeg">
                                    </div>
                                </div>

                                {{-- Current Image Preview --}}
                                @if(isset($product) && $product->foto)
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-3">Foto saat ini:</p>
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $product->foto) }}" 
                                                 alt="Foto Produk"
                                                 class="w-full h-48 object-cover rounded-lg shadow-md">
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition-all duration-200 flex items-center justify-center">
                                                <span class="text-white opacity-0 group-hover:opacity-100 text-sm font-medium">Foto saat ini</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Footer --}}
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <a href="{{ route('umkm_produk') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>

                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        @if(isset($product))
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Update Produk
                        @else
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Simpan Produk
                        @endif
                    </button>
                </div>
            </form>
        </div>

        {{-- Tips Card --}}
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-blue-900 mb-2">Tips untuk Produk yang Menarik:</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Gunakan nama produk yang jelas dan mudah dipahami</li>
                        <li>• Tulis deskripsi yang detail dan menarik</li>
                        <li>• Upload foto produk dengan kualitas yang baik</li>
                        <li>• Pilih kategori yang sesuai agar mudah ditemukan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>