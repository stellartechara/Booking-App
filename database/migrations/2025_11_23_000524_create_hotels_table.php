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
        Schema::create('hotels', function (Blueprint $table) {
            // Kolom Utama
            $table->id();

            // Kolom Data
            $table->string('name', 255);
            $table->string('image', 255)->nullable(); // Diasumsikan image bisa kosong (nullable)
            $table->text('description')->nullable(); // Diasumsikan description bisa kosong
            $table->string('location', 255);
            
            // Kolom Timestamp Otomatis Laravel
            $table->timestamps();
            
            // Catatan: Jika Anda ingin created_at dan updated_at berfungsi seperti di MySQL Anda (DEFAULT CURRENT_TIMESTAMP),
            // maka fungsi timestamps() Laravel sudah menangani hal ini secara default.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};