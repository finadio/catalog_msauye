<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Pastikan ini ada di fillable
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

    public function products()
    {
        return $this->hasMany(Product::class, 'umkm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}