<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    // Daftar kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'phone',
        'whatsapp',
        'instagram',
        'tiktok',
        'website',
        'photo',
    ];

    // Relasi ke produk
    public function products()
    {
        return $this->hasMany(Product::class, 'umkm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
