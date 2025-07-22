<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'umkm_id',
        'name',
        'description',
        'price',
        'category_id',
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
    // App\Models\Product.php
    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id'); // pastikan kolom foreign key di tabel produk bernama umkm_id
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
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