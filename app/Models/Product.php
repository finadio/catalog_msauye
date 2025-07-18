<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'category',
        'location',
        'show_price',
        'whatsapp',
        'instagram',
        'tiktok_shop',
        'images',
        'status_id',
    ];
    
    protected $casts = [
        'show_price' => 'boolean',
        'price' => 'decimal:2',
        'images' => 'array'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status()
    {
        return $this->belongsTo(ProductStatus::class);
    }
    
    public function getStatusBadgeAttribute()
{
    $name = $this->status?->name;

    return match ($name) {
        'approved' => '<span class="badge bg-success">Disetujui</span>',
        'pending' => '<span class="badge bg-warning">Menunggu</span>',
        'rejected' => '<span class="badge bg-danger">Ditolak</span>',
        default => '<span class="badge bg-secondary">Tidak diketahui</span>',
    };
}

    
    public function getFormattedPriceAttribute()
    {
        if (!$this->show_price || !$this->price) {
            return 'Hubungi Penjual';
        }
        
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
    
    public function getCategoryNameAttribute()
    {
        $categories = [
            'makanan' => 'Makanan & Minuman',
            'fashion' => 'Fashion & Pakaian',
            'kerajinan' => 'Kerajinan Tangan',
            'elektronik' => 'Elektronik',
            'kesehatan' => 'Kesehatan & Kecantikan',
            'rumah_tangga' => 'Rumah Tangga',
            'pendidikan' => 'Pendidikan & Buku',
            'olahraga' => 'Olahraga & Outdoor',
            'jasa' => 'Jasa & Layanan',
            'lainnya' => 'Lainnya'
        ];
        
        return $categories[$this->category] ?? $this->category;
    }
}