<?php

namespace App\Models;

use App\Models\Category; // Pastikan ini diimpor jika menggunakan Type Hinting
use App\Models\Umkm; // Pastikan ini diimpor
use App\Models\ProductStatus; // Pastikan ini diimpor
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
        'photo', // Ini sudah benar, asalkan di database namanya juga 'photo' dan tipe string
        'website',
        'telepon',
        'status_id',
    ];

    protected $casts = [
        'show_price' => 'boolean',
        'price' => 'decimal:2',
        // Hapus casting 'images' ke array. Kolom 'photo' (string) tidak perlu dicasting ke array.
        // Jika Anda sebelumnya memiliki kolom 'images' dan sekarang diganti 'photo',
        // maka baris ini harus dihapus.
        // 'images' => 'array' // <--- HAPUS BARIS INI
    ];

    // Hapus relasi 'user()' ini. Produk berelasi dengan UMKM melalui umkm_id,
    // dan UMKM yang berelasi dengan user.
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class);
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }

    public function category()
    {
        // Pastikan nama foreign key di tabel 'products' adalah 'category_id'
        // dan mereferensikan 'id' di tabel 'categories'.
        return $this->belongsTo(Category::class);
    }

    public function getStatusBadgeAttribute()
    {
        $name = $this->status?->name; // Mengakses nama status melalui relasi

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

    // Accessor ini perlu diubah untuk mengakses nama kategori melalui relasi 'category()'
    public function getCategoryNameAttribute()
    {
        // Mengembalikan nama kategori jika relasi ada, jika tidak, kembalikan 'Tidak Diketahui'
        return $this->category->name ?? 'Tidak Diketahui';
    }
}