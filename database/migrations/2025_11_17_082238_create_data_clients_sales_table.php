<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_clients_sales', function (Blueprint $table) {

            // Primary Key UUID
            $table->uuid('id')->primary();

            // FK ke users(id)
            $table->uuid('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            // FK ke data_paket
            $table->uuid('paket_id');
            $table->foreign('paket_id')->references('id')->on('data_paket')->onDelete('restrict');

            // Data pelanggan
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();

            // Status prospek
            $table->enum('status', ['pending', 'process', 'active', 'reject'])->default('pending');

            // Relasi ke client prospect (uuid)
            $table->uuid('client_prospect_id')->nullable()->index();

            // Lokasi
            $table->string('loc_client')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();

            // Foto
            $table->string('foto_depan')->nullable();

            // Fee
            $table->integer('fee')->default(0);
            $table->boolean('fee_paid')->default(0);
            $table->dateTime('fee_date_paid')->nullable();

            // Soft Delete + Timestamp
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_clients_sales');
    }
};
