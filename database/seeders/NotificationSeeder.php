<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Notifications\NewUserRegisteredNotification;
use App\Notifications\NewProductSubmittedNotification;
use App\Notifications\ProductStatusChangedNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan notifikasi yang ada
        DB::table('notifications')->truncate();

        // Ambil admin dan UMKM users
        $admin = User::where('role', 'admin')->first();
        $umkmUsers = User::where('role', 'umkm')->take(3)->get();
        $products = Product::take(3)->get();

        if ($admin) {
            // Buat notifikasi untuk admin - pendaftaran UMKM baru
            foreach ($umkmUsers as $index => $umkmUser) {
                $admin->notify(new NewUserRegisteredNotification($umkmUser));
                
                // Tambahkan delay untuk created_at yang berbeda
                if ($index > 0) {
                    DB::table('notifications')
                        ->where('notifiable_id', $admin->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(1)
                        ->update([
                            'created_at' => now()->subHours($index),
                            'updated_at' => now()->subHours($index)
                        ]);
                }
            }

            // Buat notifikasi untuk admin - produk baru disubmit
            foreach ($products as $index => $product) {
                $admin->notify(new NewProductSubmittedNotification($product));
                
                // Tambahkan delay untuk created_at yang berbeda
                if ($index > 0) {
                    DB::table('notifications')
                        ->where('notifiable_id', $admin->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(1)
                        ->update([
                            'created_at' => now()->subHours($index + 3),
                            'updated_at' => now()->subHours($index + 3)
                        ]);
                }
            }

            // Buat beberapa notifikasi tambahan untuk admin
            for ($i = 1; $i <= 8; $i++) {
                $dummyUser = new User([
                    'name' => 'UMKM Test ' . $i,
                    'email' => 'test' . $i . '@example.com'
                ]);
                
                $admin->notify(new NewUserRegisteredNotification($dummyUser));
                
                // Update created_at untuk variasi waktu
                DB::table('notifications')
                    ->where('notifiable_id', $admin->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(1)
                    ->update([
                        'created_at' => now()->subHours($i + 6),
                        'updated_at' => now()->subHours($i + 6)
                    ]);
            }
        }

        // Buat notifikasi untuk UMKM users - status produk berubah
        foreach ($umkmUsers as $index => $umkmUser) {
            if ($products->count() > $index) {
                $product = $products[$index];
                
                // Notifikasi produk disetujui
                $umkmUser->notify(new ProductStatusChangedNotification($product, 'approved'));
                
                // Update created_at
                DB::table('notifications')
                    ->where('notifiable_id', $umkmUser->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(1)
                    ->update([
                        'created_at' => now()->subHours($index + 1),
                        'updated_at' => now()->subHours($index + 1)
                    ]);

                // Notifikasi produk ditolak (untuk variasi)
                $umkmUser->notify(new ProductStatusChangedNotification($product, 'rejected'));
                
                // Update created_at
                DB::table('notifications')
                    ->where('notifiable_id', $umkmUser->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(1)
                    ->update([
                        'created_at' => now()->subHours($index + 4),
                        'updated_at' => now()->subHours($index + 4)
                    ]);
            }
        }

        // Buat notifikasi khusus untuk UMKM dengan email umkm@example.com
        $specificUmkmUser = User::where('email', 'umkm@example.com')->first();
        
        if ($specificUmkmUser) {
            // Ambil produk milik UMKM ini jika ada
            $umkmProducts = Product::whereHas('umkm', function($query) use ($specificUmkmUser) {
                $query->where('user_id', $specificUmkmUser->id);
            })->take(2)->get();

            // Jika tidak ada produk, buat dummy product untuk notifikasi
            if ($umkmProducts->isEmpty()) {
                $dummyProduct = new Product([
                    'name' => 'Produk Contoh UMKM',
                    'description' => 'Ini adalah produk contoh untuk notifikasi',
                    'price' => 50000
                ]);
                $dummyProduct->id = 999; // Set dummy ID
                $umkmProducts = collect([$dummyProduct]);
            }

            // Notifikasi status produk disetujui
            foreach ($umkmProducts as $index => $product) {
                $specificUmkmUser->notify(new ProductStatusChangedNotification($product, 'approved'));
                
                DB::table('notifications')
                    ->where('notifiable_id', $specificUmkmUser->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(1)
                    ->update([
                        'created_at' => now()->subHours($index + 1),
                        'updated_at' => now()->subHours($index + 1)
                    ]);
            }

            // Notifikasi status produk ditolak
            if ($umkmProducts->count() > 0) {
                $specificUmkmUser->notify(new ProductStatusChangedNotification($umkmProducts->first(), 'rejected'));
                
                DB::table('notifications')
                    ->where('notifiable_id', $specificUmkmUser->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(1)
                    ->update([
                        'created_at' => now()->subHours(3),
                        'updated_at' => now()->subHours(3)
                    ]);
            }

            // Buat notifikasi manual tambahan untuk UMKM ini
            $additionalNotifications = [
                [
                    'title' => 'Selamat Datang di Platform UMKM',
                    'message' => 'Terima kasih telah bergabung dengan platform kami. Mulai jual produk Anda sekarang!',
                    'type' => 'welcome',
                    'icon' => 'fas fa-hand-wave',
                    'color' => 'primary',
                    'action_url' => route('umkm_produk'),
                    'hours_ago' => 24
                ],
                [
                    'title' => 'Tips Meningkatkan Penjualan',
                    'message' => 'Lengkapi profil UMKM Anda dan tambahkan foto produk yang menarik untuk meningkatkan penjualan.',
                    'type' => 'tip',
                    'icon' => 'fas fa-lightbulb',
                    'color' => 'warning',
                    'action_url' => route('umkm_produk'),
                    'hours_ago' => 12
                ],
                [
                    'title' => 'Pembaruan Sistem',
                    'message' => 'Sistem telah diperbarui dengan fitur-fitur baru. Jelajahi dashboard Anda untuk melihat peningkatan.',
                    'type' => 'system_update',
                    'icon' => 'fas fa-sync-alt',
                    'color' => 'info',
                    'action_url' => route('umkm_dashboard'),
                    'hours_ago' => 6
                ],
                [
                    'title' => 'Promosi Produk',
                    'message' => 'Jangan lupa untuk mempromosikan produk Anda di media sosial untuk jangkauan yang lebih luas.',
                    'type' => 'promotion',
                    'icon' => 'fas fa-bullhorn',
                    'color' => 'success',
                    'action_url' => route('umkm_produk'),
                    'hours_ago' => 2
                ]
            ];

            foreach ($additionalNotifications as $notifData) {
                // Insert manual notification
                DB::table('notifications')->insert([
                    'id' => \Illuminate\Support\Str::uuid(),
                    'type' => 'App\\Notifications\\CustomUmkmNotification',
                    'notifiable_type' => 'App\\Models\\User',
                    'notifiable_id' => $specificUmkmUser->id,
                    'data' => json_encode($notifData),
                    'read_at' => null,
                    'created_at' => now()->subHours($notifData['hours_ago']),
                    'updated_at' => now()->subHours($notifData['hours_ago'])
                ]);
            }

            $this->command->info('Created additional notifications for UMKM user: umkm@example.com');
        } else {
            $this->command->warn('UMKM user with email umkm@example.com not found!');
        }

        $this->command->info('Notification seeder completed successfully!');
        $this->command->info('Created notifications for admin, UMKM users, and specific UMKM user');
    }
}
