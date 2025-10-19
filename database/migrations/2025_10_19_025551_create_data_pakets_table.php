<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_paket', function (Blueprint $table) {
            // Primary key UUID
            $table->uuid('id')->primary();

            // Kolom-kolom sesuai spesifikasi
            $table->string('nama_paket');
            $table->string('deskripsi')->nullable();
            $table->string('harga');              // disimpan sebagai varchar sesuai request
            $table->string('name_profile')->nullable();
            $table->string('limit_radius')->nullable();

            // Audit
            $table->timestamps();
            $table->softDeletes(); // softdeleted
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_paket');
    }
};
