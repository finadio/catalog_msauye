<x-app-layout>
    <div class="pt-20 pb-10 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-10 border border-white/20 relative overflow-hidden">

                {{-- Decorative Background Elements --}}
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-full -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-emerald-400/10 to-blue-400/10 rounded-full -ml-16 -mb-16"></div>

                {{-- Header dan tombol kembali --}}
                <div class="flex items-center justify-between mb-10 relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-700 to-purple-600 bg-clip-text text-transparent">
                            Edit Produk
                        </h1>
                    </div>
                    <a href="{{ route('umkm_produk') }}"
                        class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition-all duration-200 border border-blue-200 hover:border-blue-300 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke daftar produk
                    </a>
                </div>

                <form action="{{ route('umkm_produkupdate', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
                    @csrf

                    {{-- Basic Information Section --}}
                    <div class="bg-gradient-to-r from-gray-50/50 to-blue-50/50 rounded-2xl p-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            Informasi Dasar
                        </h3>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            {{-- Nama Produk --}}
                            <div class="lg:col-span-2">
                                <label for="product_name" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Nama Produk
                                </label>
                                <input type="text" name="name" id="product_name" value="{{ $product->name }}"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3 text-gray-800 font-medium transition-all duration-200 bg-white/70 backdrop-blur-sm"
                                    required>
                            </div>

                            {{-- Kategori --}}
                            <div>
                                <label for="product_category" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Kategori
                                </label>
                                <select name="category_id" id="product_category"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3 text-gray-800 font-medium transition-all duration-200 bg-white/70 backdrop-blur-sm">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Harga --}}
                            <div>
                                <label for="product_price" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    Harga (Rp)
                                </label>
                                <div class="relative">
                                    <input type="number" name="price" id="product_price" value="{{ $product->price }}"
                                        class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pl-12 pr-4 py-3 text-gray-800 font-medium transition-all duration-200 bg-white/70 backdrop-blur-sm">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-bold">
                                        Rp
                                    </div>
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="lg:col-span-2">
                                <label for="product_description" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Deskripsi
                                </label>
                                <textarea name="description" id="product_description" rows="4"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3 text-gray-800 font-medium transition-all duration-200 bg-white/70 backdrop-blur-sm resize-none"
                                    placeholder="Deskripsikan produk Anda dengan detail...">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Information Section --}}
                    <div class="bg-gradient-to-r from-emerald-50/50 to-blue-50/50 rounded-2xl p-8 border border-emerald-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            Informasi Kontak
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="umkm_whatsapp" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.108"/>
                                    </svg>
                                    WhatsApp
                                </label>
                                <input type="text" name="whatsapp" id="umkm_whatsapp" value="{{ $product->umkm->whatsapp ?? '' }}"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 px-4 py-3 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                                    placeholder="628123456789">
                            </div>

                            <div>
                                <label for="umkm_instagram" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                    Instagram
                                </label>
                                <input type="text" name="instagram" id="umkm_instagram" value="{{ $product->umkm->instagram ?? '' }}"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 px-4 py-3 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                                    placeholder="@username">
                            </div>

                            <div>
                                <label for="umkm_tiktok" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-2.08v7.89c0 2.08-1.69 3.77-3.77 3.77A3.78 3.78 0 016.2 9.89 3.78 3.78 0 0110 6.12V4A5.86 5.86 0 004.12 9.89a5.86 5.86 0 005.88 5.88 5.86 5.86 0 005.88-5.88V8.1a6.54 6.54 0 003.84 1.23 4.83 4.83 0 01-.13-2.64z"/>
                                    </svg>
                                    TikTok
                                </label>
                                <input type="text" name="tiktok" id="umkm_tiktok" value="{{ $product->umkm->tiktok ?? '' }}"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-gray-500 focus:border-gray-500 px-4 py-3 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                                    placeholder="@username">
                            </div>

                            <div>
                                <label for="umkm_website" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    Website
                                </label>
                                <input type="url" name="website" id="umkm_website" value="{{ $product->umkm->website ?? '' }}"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                                    placeholder="https://www.example.com">
                            </div>

                            <div class="md:col-span-2">
                                <label for="umkm_telepon" class="block font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Telepon
                                </label>
                                <input type="text" name="telepon" id="umkm_telepon" value="{{ $product->umkm->phone ?? '' }}"
                                    class="w-full rounded-2xl border-2 border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                                    placeholder="0274-123456">
                            </div>
                        </div>
                    </div>

                    {{-- Photo Section --}}
                    <div class="bg-gradient-to-r from-purple-50/50 to-pink-50/50 rounded-2xl p-8 border border-purple-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            Foto Produk
                        </h3>

                        <div class="space-y-6">
                            <div>
                                <label for="new_product_photo" class="block font-bold text-gray-700 mb-3">
                                    Upload Foto Baru (opsional)
                                </label>
                                <div class="relative">
                                    <input type="file" name="photo" id="new_product_photo" accept="image/*"
                                        class="w-full rounded-2xl border-2 border-dashed border-gray-300 hover:border-purple-400 px-6 py-8 text-center transition-all duration-200 bg-white/50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-purple-50 file:text-purple-700 file:font-semibold hover:file:bg-purple-100">
                                </div>
                            </div>

                            @if($product->photo)
                                <div>
                                    <label class="block font-bold text-gray-700 mb-3">
                                        Foto Saat Ini
                                    </label>
                                    <div class="relative inline-block">
                                        <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}" alt="Foto Produk"
                                            class="w-40 h-40 object-cover rounded-2xl shadow-lg border-4 border-white">
                                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/20 to-transparent"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end pt-6">
                        <button type="submit" id="perbarui_produk_btn"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-200 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>