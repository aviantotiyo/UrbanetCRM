<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('warehouse')->create('data_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_barang')->unique()->nullable();
            $table->string('nama_barang');
            $table->uuid('category_id');

            $table->enum('unit_type', ['unit', 'roll', 'meter', 'lainnya']);
            $table->text('spesifikasi')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->string('img')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign Key constraint
            $table->foreign('category_id')->references('id')->on('data_categories');
        });
    }

    public function down(): void
    {
        Schema::connection('warehouse')->dropIfExists('data_items');
    }
};
