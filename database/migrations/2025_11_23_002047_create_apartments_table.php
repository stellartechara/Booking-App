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
        // PENTING: Menggunakan nama tabel 'apartments' sesuai dengan Model Anda.
        Schema::create('apartments', function (Blueprint $table) {
            // Kolom Utama
            $table->id();
            
            // Detail Kamar/Apartemen
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
            $table->integer('max_persons');
            $table->integer('size');
            $table->string('view', 255)->nullable();
            $table->integer('num_beds');
            $table->string('price', 255); 

            // Foreign Key (Relasi ke tabel hotels)
            $table->integer('hotel_id');
            
            // Timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};