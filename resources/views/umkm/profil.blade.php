@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Profil UMKM</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('umkm.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Avatar -->
                        <div class="row mb-3">
                            <label for="avatar" class="col-md-4 col-form-label text-md-end">Foto Profil</label>
                            <div class="col-md-6">
                                @if($user->avatar)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" 
                                             alt="Avatar" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @endif
                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" 
                                       name="avatar" accept="image/*">
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nama -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nomor Telepon -->
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Nomor Telepon</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Alamat -->
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Alamat</label>
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" 
                                          name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nama Usaha -->
                        <div class="row mb-3">
                            <label for="business_name" class="col-md-4 col-form-label text-md-end">Nama Usaha</label>
                            <div class="col-md-6">
                                <input id="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" 
                                       name="business_name" value="{{ old('business_name', $user->business_name) }}">
                                @error('business_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Deskripsi Usaha -->
                        <div class="row mb-3">
                            <label for="business_description" class="col-md-4 col-form-label text-md-end">Deskripsi Usaha</label>
                            <div class="col-md-6">
                                <textarea id="business_description" class="form-control @error('business_description') is-invalid @enderror" 
                                          name="business_description" rows="4">{{ old('business_description', $user->business_description) }}</textarea>
                                @error('business_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        <h5 class="mb-3">Kontak Media Sosial</h5>
                        
                        <!-- WhatsApp -->
                        <div class="row mb-3">
                            <label for="whatsapp" class="col-md-4 col-form-label text-md-end">WhatsApp</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">+62</span>
                                    <input id="whatsapp" type="text" class="form-control @error('whatsapp') is-invalid @enderror" 
                                           name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" placeholder="8123456789">
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
                            <label for="instagram" class="col-md-4 col-form-label text-md-end">Instagram</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" 
                                           name="instagram" value="{{ old('instagram', $user->instagram) }}" placeholder="username">
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
                            <label for="tiktok_shop" class="col-md-4 col-form-label text-md-end">TikTok Shop</label>
                            <div class="col-md-6">
                                <input id="tiktok_shop" type="text" class="form-control @error('tiktok_shop') is-invalid @enderror" 
                                       name="tiktok_shop" value="{{ old('tiktok_shop', $user->tiktok_shop) }}" placeholder="Link TikTok Shop">
                                @error('tiktok_shop')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('umkm.dashboard') }}" class="btn btn-secondary ms-2">
                                    Kembali
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