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
        Schema::create('booking', function (Blueprint $table) {
            // Kolom Utama
            $table->id();
            
            // Data Tamu
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone_number', 13);
            
            // Detail Pemesanan
            $table->string('check_in', 255);
            $table->string('check_out', 255);
            $table->integer('days');
            $table->integer('price');
            
            // Informasi Referensi
            $table->integer('user_id')->nullable(); // Diasumsikan bisa null jika tamu tidak login
            $table->string('room_name', 255);
            $table->string('hotel_name', 255);
            
            // Status
            $table->string('status', 255)->default('Processing'); // Nilai default "Processing"
            
            // Timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};