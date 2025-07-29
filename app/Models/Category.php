<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Hanya kolom 'name' yang boleh diisi secara massal untuk Category
    ];

    // Alternatif (jika Anda ingin semua kolom boleh diisi kecuali yang dijaga):
    // protected $guarded = []; // Array kosong berarti tidak ada kolom yang dijaga dari mass assignment
}