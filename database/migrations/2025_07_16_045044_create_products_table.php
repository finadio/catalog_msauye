<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Ini sudah benar untuk auto-incrementing primary key
            
            // Perbaikan: Ubah foreignId('user_id') menjadi foreignId('umkm_id')
            // untuk mereferensikan tabel 'umkms' dan cocok dengan logika controller
            $table->foreignId('umkm_id')->constrained('umkms')->onDelete('cascade');
            
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 15, 2)->nullable();
            
            // Perbaikan: Ubah 'category' (string) menjadi foreignId('category_id')
            // untuk mereferensikan tabel 'categories'
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            $table->string('location')->nullable(); // Ditambahkan nullable karena di form create tidak ada.
            $table->boolean('show_price')->default(true);
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok_shop')->nullable();
            
            // Perbaikan: Ubah 'images' (json) menjadi 'photo' (string) dan nullable
            // Ini agar sesuai dengan cara Anda menyimpan foto di controller
            $table->string('photo')->nullable(); 
            
            $table->string('website')->nullable();
            $table->string('telepon')->nullable();
            
            // Perbaikan: Ubah 'status' (enum) menjadi foreignId('status_id')
            // untuk mereferensikan tabel 'product_statuses'
            $table->foreignId('status_id')->constrained('product_statuses')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};