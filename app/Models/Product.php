<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'umkm_id', 'category_id', 'name', 'description', 'price', 'photo', 'status_id'
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Tambahkan relasi status ini
    public function status()
    {
        return $this->belongsTo(ProductStatus::class);
    }
}