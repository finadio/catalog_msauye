<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use App\Models\Umkm; // Import model Umkm

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user UMKM jika belum ada (atau dapatkan yang sudah ada)
        $umkmUser = User::firstOrCreate(
            ['email' => 'umkm@example.com'], // Kriteria pencarian
            [
                'name' => 'Seller UMKM Test',
                'password' => bcrypt('password'), // Password standar
                'role' => 'umkm',
                'email_verified_at' => now(), // Opsional: Verifikasi email otomatis
            ]
        );

        // Buat entri UMKM untuk user ini jika belum ada
        Umkm::updateOrCreate(
            ['user_id' => $umkmUser->id],
            [
                'name' => 'Toko UMKM Test',
                'description' => 'Menyediakan produk kerajinan tangan lokal.',
                'address' => 'Jl. Contoh UMKM No. 1, Yogyakarta',
                'phone' => '08123456789',
                'whatsapp' => '628123456789',
                'instagram' => 'umkm_test_id',
                'photo' => 'https://loremflickr.com/640/480/store', // Foto dummy
            ]
        );

        // Contoh lain: Buat beberapa UMKM dummy
        // \App\Models\Umkm::factory(5)->create(); // Ini butuh UmkmFactory

            // Tambahan data dummy UMKM (Total 20 items)
            $dummyUmkm = [
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'UMKM Batik Ceria',
                    'description' => 'Menjual batik modern dan tradisional.',
                    'address' => 'Jl. Batik No. 2, Solo',
                    'phone' => '08123456780',
                    'whatsapp' => '628123456780',
                    'instagram' => 'batikceria',
                    'photo' => 'https://loremflickr.com/640/480/batik,cloth',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'UMKM Kerajinan Kayu',
                    'description' => 'Kerajinan kayu handmade untuk dekorasi.',
                    'address' => 'Jl. Kayu No. 3, Magelang',
                    'phone' => '08123456781',
                    'whatsapp' => '628123456781',
                    'instagram' => 'kerajinankayu',
                    'photo' => 'https://loremflickr.com/640/480/wood,craft',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'UMKM Kuliner Nusantara',
                    'description' => 'Makanan khas nusantara siap saji.',
                    'address' => 'Jl. Kuliner No. 4, Jakarta',
                    'phone' => '08123456782',
                    'whatsapp' => '628123456782',
                    'instagram' => 'kulinernusantara',
                    'photo' => 'https://loremflickr.com/640/480/food,indonesian',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Batik Indah Ceria',
                    'description' => 'Pakaian batik modern dan tradisional berkualitas tinggi.',
                    'address' => 'Jl. Mode No. 8, Solo',
                    'phone' => '089988776655',
                    'whatsapp' => '6289988776655',
                    'instagram' => 'batikindahceria',
                    'photo' => 'https://loremflickr.com/640/480/batik,fashion',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Digital Solusi Kreasi',
                    'description' => 'Jasa pembuatan website dan desain grafis untuk UMKM.',
                    'address' => 'Jl. Kreatif No. 12, Bandung',
                    'phone' => '081211223344',
                    'whatsapp' => '6281211223344',
                    'instagram' => 'digitalsolusi',
                    'photo' => 'https://loremflickr.com/640/480/computer,design',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Kerajinan Jaya',
                    'description' => 'Menyediakan aneka kerajinan tangan khas lokal.',
                    'address' => 'Jl. Seni No. 10, Yogyakarta',
                    'phone' => '087811223344',
                    'whatsapp' => '6287811223344',
                    'instagram' => 'kerajinanjaya',
                    'photo' => 'https://loremflickr.com/640/480/handcraft,art',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Kuliner Nusantara',
                    'description' => 'Menyediakan masakan tradisional Indonesia.',
                    'address' => 'Jl. Rasa No. 5, Jakarta',
                    'phone' => '081122334455',
                    'whatsapp' => '6281122334455',
                    'instagram' => 'kulinernusantara_asli',
                    'photo' => 'https://loremflickr.com/640/480/indonesian,food',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Kopi Senja Abadi',
                    'description' => 'Kopi lokal pilihan dengan cita rasa khas pegunungan.',
                    'address' => 'Jl. Kopi No. 9, Aceh',
                    'phone' => '081234567890',
                    'whatsapp' => '6281234567890',
                    'instagram' => 'kopisenja',
                    'photo' => 'https://loremflickr.com/640/480/coffee,beans',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Tenun Ikat Sumba',
                    'description' => 'Kain tenun ikat asli Sumba dengan motif tradisional.',
                    'address' => 'Jl. Tenun No. 11, Sumba',
                    'phone' => '081234567891',
                    'whatsapp' => '6281234567891',
                    'instagram' => 'tenunsumba',
                    'photo' => 'https://loremflickr.com/640/480/fabric,textile',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Madu Hutan Murni',
                    'description' => 'Madu hutan asli tanpa campuran bahan kimia.',
                    'address' => 'Jl. Lebah No. 15, Sumbawa',
                    'phone' => '081234567892',
                    'whatsapp' => '6281234567892',
                    'instagram' => 'maduhutan',
                    'photo' => 'https://loremflickr.com/640/480/honey,nature',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Keripik Buah Segar',
                    'description' => 'Camilan sehat dari buah-buahan segar pilihan.',
                    'address' => 'Jl. Buah No. 20, Malang',
                    'phone' => '081234567893',
                    'whatsapp' => '6281234567893',
                    'instagram' => 'keripikbuah',
                    'photo' => 'https://loremflickr.com/640/480/chips,fruit',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Sepatu Kulit Garut',
                    'description' => 'Sepatu kulit asli buatan tangan pengrajin Garut.',
                    'address' => 'Jl. Kulit No. 25, Garut',
                    'phone' => '081234567894',
                    'whatsapp' => '6281234567894',
                    'instagram' => 'sepatukulit',
                    'photo' => 'https://loremflickr.com/640/480/shoes,leather',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Hijab Modern Style',
                    'description' => 'Koleksi hijab modern dengan bahan nyaman.',
                    'address' => 'Jl. Hijab No. 30, Bandung',
                    'phone' => '081234567895',
                    'whatsapp' => '6281234567895',
                    'instagram' => 'hijabstyle',
                    'photo' => 'https://loremflickr.com/640/480/hijab,fashion',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Sambal Roa Manado',
                    'description' => 'Sambal roa khas Manado yang pedas dan gurih.',
                    'address' => 'Jl. Pedas No. 35, Manado',
                    'phone' => '081234567896',
                    'whatsapp' => '6281234567896',
                    'instagram' => 'sambalroa',
                    'photo' => 'https://loremflickr.com/640/480/chili,food',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Tas Anyaman Bali',
                    'description' => 'Tas anyaman rotan unik khas Bali.',
                    'address' => 'Jl. Rotan No. 40, Bali',
                    'phone' => '081234567897',
                    'whatsapp' => '6281234567897',
                    'instagram' => 'tasanyaman',
                    'photo' => 'https://loremflickr.com/640/480/bag,rattan',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Silver Jewelry Kotagede',
                    'description' => 'Perhiasan perak handmade dari Kotagede.',
                    'address' => 'Jl. Perak No. 45, Yogyakarta',
                    'phone' => '081234567898',
                    'whatsapp' => '6281234567898',
                    'instagram' => 'silverjewelry',
                    'photo' => 'https://loremflickr.com/640/480/jewelry,silver',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Organic Soap Natural',
                    'description' => 'Sabun organik dari bahan alami ramah lingkungan.',
                    'address' => 'Jl. Sabun No. 50, Bali',
                    'phone' => '081234567899',
                    'whatsapp' => '6281234567899',
                    'instagram' => 'organicsoap',
                    'photo' => 'https://loremflickr.com/640/480/soap,natural',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Pottery Art Studio',
                    'description' => 'Keramik hias dan peralatan makan unik.',
                    'address' => 'Jl. Keramik No. 55, Kasongan',
                    'phone' => '081234567800',
                    'whatsapp' => '6281234567800',
                    'instagram' => 'potteryart',
                    'photo' => 'https://loremflickr.com/640/480/pottery,ceramic',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Rendang Padang Asli',
                    'description' => 'Rendang daging sapi dengan bumbu rempah asli Padang.',
                    'address' => 'Jl. Rendang No. 60, Padang',
                    'phone' => '081234567801',
                    'whatsapp' => '6281234567801',
                    'instagram' => 'rendangasli',
                    'photo' => 'https://loremflickr.com/640/480/meat,food',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'Furniture Jati Jepara',
                    'description' => 'Mebel kayu jati ukir kualitas ekspor.',
                    'address' => 'Jl. Jati No. 65, Jepara',
                    'phone' => '081234567802',
                    'whatsapp' => '6281234567802',
                    'instagram' => 'furniturejati',
                    'photo' => 'https://loremflickr.com/640/480/furniture,wood',
                ],
            ];
            foreach ($dummyUmkm as $umkm) {
                \App\Models\Umkm::updateOrCreate([
                    'name' => $umkm['name'],
                ], $umkm);
            }

            // Fix for any other UMKMs that might be missing photos
            $allUmkms = \App\Models\Umkm::all();
            foreach ($allUmkms as $umkm) {
                if (empty($umkm->photo) || $umkm->photo === 'umkm-default.png' || !str_starts_with($umkm->photo, 'http')) {
                    $keyword = 'business';
                    if (stripos($umkm->name, 'batik') !== false) $keyword = 'batik';
                    elseif (stripos($umkm->name, 'kuliner') !== false || stripos($umkm->name, 'makanan') !== false) $keyword = 'food';
                    elseif (stripos($umkm->name, 'kerajinan') !== false || stripos($umkm->name, 'craft') !== false) $keyword = 'craft';
                    elseif (stripos($umkm->name, 'digital') !== false || stripos($umkm->name, 'tech') !== false) $keyword = 'technology';
                    elseif (stripos($umkm->name, 'fashion') !== false || stripos($umkm->name, 'baju') !== false) $keyword = 'fashion';
                    
                    $umkm->photo = "https://loremflickr.com/640/480/{$keyword}";
                    $umkm->save();
                }
            }
    }
}