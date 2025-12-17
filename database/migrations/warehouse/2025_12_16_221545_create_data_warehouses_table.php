<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('warehouse')->create('data_warehouses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_gudang')->unique();
            $table->string('nama_gudang');
            $table->text('lokasi')->nullable();
            $table->enum('jenis', ['internal', 'personal']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('warehouse')->dropIfExists('data_warehouses');
    }
};
