<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Pastikan ini ada jika menggunakan Sanctum
use App\Models\Umkm; // Penting: Pastikan model Umkm diimpor

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable; // Tambahkan HasApiTokens jika menggunakan Sanctum

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELASI UNTUK UMKM: User memiliki satu UMKM
    // Ini adalah definisi relasi hasOne yang benar.
    // Laravel akan mencari 'user_id' di tabel 'umkms'.
    public function umkm()
    {
        return $this->hasOne(Umkm::class);
    }

    // Relasi 'produk()' dan 'products()' di bawah ini dihapus karena
    // relasi user ke produk seharusnya melalui model UMKM.
    // User -> Umkm (hasOne) -> Products (hasMany)

    // public function produk()
    // {
    //     return $this->hasMany(\App\Models\Produk::class, 'user_id');
    // }

    // public function products()
    // {
    //     return $this->hasMany(\App\Models\Product::class, 'umkm_id');
    // }

    // Helper methods untuk status
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
