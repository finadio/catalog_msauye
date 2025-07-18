<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'name',
        'description',
        'address', 
        'phone',
        'whatsapp',
        'instagram', 
        'photo', // kalau ada relasi ke user
    ];
}
