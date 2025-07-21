<x-app-layout>
    <h2>{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</h2>

    <form method="POST" action="{{ isset($product) ? route('umkm.produk.update', $product->id) : route('umkm.produk.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <label>Nama</label>
        <input type="text" name="nama" value="{{ $product->nama ?? old('nama') }}" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" required>{{ $product->deskripsi ?? old('deskripsi') }}</textarea>

        <label>Harga</label>
        <input type="number" name="harga" value="{{ $product->harga ?? old('harga') }}">

        <label>Kategori</label>
        <select name="kategori_id" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(isset($product) && $product->kategori_id == $cat->id)>
                    {{ $cat->nama }}
                </option>
            @endforeach
        </select>

        <label>Foto</label>
        <input type="file" name="foto">

        <button type="submit">{{ isset($product) ? 'Update' : 'Simpan' }}</button>
    </form>
</x-app-layout>
