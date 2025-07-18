<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // Penting: ini untuk menautkan UMKM ke user yang membuatnya
        'name',
        'description',
        'address',
        'phone',
        'whatsapp',
        'instagram',
        'tiktok',    // Kolom baru
        'website',   // Kolom baru
        'photo',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Tambahkan relasi ini untuk bisa mengakses user dari UMKM
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}