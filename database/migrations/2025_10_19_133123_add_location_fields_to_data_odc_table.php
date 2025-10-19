<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_odc', function (Blueprint $table) {
            // Tambahkan berurutan setelah 'nama_odc'
            $table->string('alamat')->nullable()->after('nama_odc');
            $table->string('prov')->nullable()->after('alamat');
            $table->string('kota')->nullable()->after('prov');
            $table->string('kec')->nullable()->after('kota');
            $table->string('desa')->nullable()->after('kec');
            $table->string('loc_odp')->nullable()->after('desa');
            $table->string('lat')->nullable()->after('loc_odp');
            // Catatan: nama kolom 'long' adalah kata yang bisa berbenturan dengan tipe data di SQL,
            // namun Laravel akan me-quote otomatis (`long`). Aman, tapi kalau mau lebih aman bisa pakai 'lng' / 'longitude'.
            $table->string('long')->nullable()->after('lat');
        });
    }

    public function down(): void
    {
        Schema::table('data_odc', function (Blueprint $table) {
            // Drop kolom-kolom yang ditambahkan
            $table->dropColumn([
                'alamat',
                'prov',
                'kota',
                'kec',
                'desa',
                'loc_odp',
                'lat',
                'long',
            ]);
        });
    }
};
