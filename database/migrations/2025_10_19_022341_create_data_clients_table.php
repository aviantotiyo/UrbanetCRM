<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_clients', function (Blueprint $table) {
            // Primary key UUID
            $table->uuid('id')->primary();

            // Identitas pelanggan
            $table->string('nopel')->unique();      // nomor pelanggan (unique)
            $table->string('nama');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('nik')->nullable();

            // Alamat
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();

            // Lokasi & paket/tagihan (varchar sesuai request)
            $table->string('loc_client')->nullable();   // mis. "lat,long" atau deskripsi singkat
            $table->string('paket')->nullable();
            $table->string('tagihan')->nullable();      // kalau nanti mau numeric, ganti ke bigInteger

            // PPPoE
            $table->string('user_pppoe')->unique();
            $table->string('pass_pppoe');

            // Profil & limit (RADIUS/MikroTik)
            $table->string('name_profile')->nullable();
            $table->string('limit_radius')->nullable();

            // Relasi ODP (tetap varchar, tanpa FK)
            $table->string('odp_id')->nullable();
            $table->string('odp_port_id')->nullable();

            // Metadata
            $table->string('tag')->nullable();
            $table->dateTime('active_user')->nullable();

            // Status layanan
            $table->enum('status', ['active', 'isolir', 'suspend', 'inactive', 'booking'])->default('booking');

            // Catatan & media
            $table->text('note')->nullable();
            $table->string('foto_depan')->nullable();

            // Audit
            $table->timestamps();
            $table->softDeletes(); // softdeleted
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_clients');
    }
};
