@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Produk Baru</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('umkm.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Upload Gambar -->
                        <div class="row mb-3">
                            <label for="images" class="col-md-3 col-form-label text-md-end">Foto Produk *</label>
                            <div class="col-md-8">
                                <input id="images" type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" 
                                       name="images[]" multiple accept="image/*" required>
                                <div class="form-text">Pilih beberapa gambar produk (maksimal 2MB per gambar)</div>
                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('images.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                <!-- Preview Images -->
                                <div id="imagePreview" class="mt-3"></div>
                            </div>
                        </div>
                        
                        <!-- Nama Produk -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-end">Nama Produk *</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Deskripsi Produk -->
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">Deskripsi Produk *</label>
                            <div class="col-md-8">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" 
                                          name="description" rows="5" required>{{ old('description') }}</textarea>
                                <div class="form-text">Jelaskan detail produk Anda secara lengkap</div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Kategori -->
                        <div class="row mb-3">
                            <label for="category" class="col-md-3 col-form-label text-md-end">Kategori *</label>
                            <div class="col-md-8">
                                <select id="category" class="form-select @error('category') is-invalid @enderror" 
                                        name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $key => $value)
                                        <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Harga -->
                        <div class="row mb-3">
                            <label for="price" class="col-md-3 col-form-label text-md-end">Harga</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" 
                                           name="price" value="{{ old('price') }}" min="0" step="1000">
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="show_price" 
                                           name="show_price" {{ old('show_price', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_price">
                                        Tampilkan harga (jika tidak dicentang akan muncul "Hubungi Penjual")
                                    </label>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="row mb-3">
                            <label for="location" class="col-md-3 col-form-label text-md-end">Lokasi *</label>
                            <div class="col-md-8">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" 
                                       name="location" value="{{ old('location') }}" required 
                                       placeholder="Contoh: Yogyakarta, DIY">
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        <h5 class="mb-3">Kontak Penjualan</h5>
                        
                        <!-- WhatsApp -->
                        <div class="row mb-3">
                            <label for="whatsapp" class="col-md-3 col-form-label text-md-end">WhatsApp</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text">+62</span>
                                    <input id="whatsapp" type="text" class="form-control @error('whatsapp') is-invalid @enderror" 
                                           name="whatsapp" value="{{ old('whatsapp', auth()->user()->whatsapp) }}" placeholder="8123456789">
                                </div>
                                @error('whatsapp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Instagram -->
                        <div class="row mb-3">
                            <label for="instagram" class="col-md-3 col-form-label text-md-end">Instagram</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" 
                                           name="instagram" value="{{ old('instagram', auth()->user()->instagram) }}" placeholder="username">
                                </div>
                                @error('instagram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- TikTok Shop -->
                        <div class="row mb-3">
                            <label for="tiktok_shop" class="col-md-3 col-form-label text-md-end">TikTok Shop</label>
                            <div class="col-md-8">
                                <input id="tiktok_shop" type="text" class="form-control @error('tiktok_shop') is-invalid @enderror" 
                                       name="tiktok_shop" value="{{ old('tiktok_shop', auth()->user()->tiktok_shop) }}" placeholder="Link TikTok Shop">
                                @error('tiktok_shop')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Produk
                                </button>
                                <a href="{{ route('umkm.products') }}" class="btn btn-secondary ms-2">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Image preview functionality
    document.getElementById('images').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = '';
        
        if (e.target.files.length > 0) {
            const files = Array.from(e.target.files);
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'd-inline-block me-2 mb-2';
                        imgDiv.innerHTML = `
                            <img src="${e.target.result}" 
                                 class="img-thumbnail" 
                                 style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="text-center">
                                <small class="text-muted">Gambar ${index + 1}</small>
                            </div>
                        `;
                        previewContainer.appendChild(imgDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
    
    // Format price input
    document.getElementById('price').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value) {
            value = parseInt(value);
            e.target.value = value;
        }
    });
</script>
@endsection
