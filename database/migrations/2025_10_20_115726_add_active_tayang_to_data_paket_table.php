<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_paket', function (Blueprint $table) {
            // Tambah kolom setelah 'harga'
            $table->boolean('active')->default(true)->after('harga');
            $table->boolean('tayang')->default(true)->after('active');
        });
    }

    public function down(): void
    {
        Schema::table('data_paket', function (Blueprint $table) {
            $table->dropColumn(['active', 'tayang']);
        });
    }
};
