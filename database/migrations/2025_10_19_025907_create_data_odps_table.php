<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_odp', function (Blueprint $table) {
            // Primary Key UUID
            $table->uuid('id')->primary();

            // Kolom-kolom sesuai spesifikasi
            $table->string('kode_odp')->unique();  // unik
            $table->string('nama_odp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('prov')->nullable();
            $table->string('kota')->nullable();
            $table->string('kec')->nullable();
            $table->string('desa')->nullable();
            $table->string('loc_odp')->nullable();     // mis: "lat,long" atau deskripsi titik
            $table->string('port_cap')->nullable();    // kapasitas port (varchar sesuai request)
            $table->string('port_install')->nullable(); // berapa yang sudah terpasang/terpakai
            $table->string('warna_core')->nullable();
            $table->string('core_cable')->nullable();
            $table->text('note')->nullable();

            // Audit
            $table->timestamps();

            // (opsional) index tambahan
            // $table->index(['prov', 'kota', 'kec']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_odp');
    }
};
