<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_server', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nama_pop');   // nama POP
            $table->string('lokasi');     // alamat/lokasi
            $table->string('ip_public');  // IP publik
            $table->string('ip_static');  // IP statik (internal/DC)
            $table->string('user');       // username akses
            $table->string('password');   // password akses (pertimbangkan enkripsi/secret)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_server');
    }
};
