<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-xl font-semibold mb-6">Edit Profil UMKM</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('umkm_updateprofile') }}" class="space-y-4 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Nama Usaha</label>
                <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded p-2" rows="3">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $umkm->lokasi) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold">Kontak WhatsApp</label>
                <input type="text" name="kontak_wa" value="{{ old('kontak_wa', $umkm->kontak_wa) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold">Instagram</label>
                <input type="text" name="kontak_ig" value="{{ old('kontak_ig', $umkm->kontak_ig) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold">Tiktok Shop</label>
                <input type="text" name="kontak_tiktok" value="{{ old('kontak_tiktok', $umkm->kontak_tiktok) }}" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </form>

        {{-- Statistik produk --}}
        <div class="mt-10 bg-white rounded-xl shadow-lg p-6">
            <h4 class="font-semibold text-gray-900 mb-4">Statistik Produk</h4>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm">Total Produk</span>
                    <span class="font-semibold text-blue-600">{{ $products->count() ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm">Produk Aktif</span>
                    <span class="font-semibold text-green-600">{{ $products->where('status.name', 'aktif')->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm">Menunggu Review</span>
                    <span class="font-semibold text-yellow-600">{{ $products->where('status.name', 'pending')->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm">Produk Ditolak</span>
                    <span class="font-semibold text-red-600">{{ $products->where('status.name', 'ditolak')->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
