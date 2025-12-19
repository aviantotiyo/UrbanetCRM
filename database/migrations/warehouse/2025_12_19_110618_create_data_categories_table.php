<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('warehouse')->create('data_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_kategori')->unique();
            $table->string('nama_kategori');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes(); // deleted_at
        });
    }

    public function down(): void
    {
        Schema::connection('warehouse')->dropIfExists('data_categories');
    }
};
