<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_clients_regist', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nik', 50)->nullable();
            $table->uuid('paket_id')->nullable();
            $table->string('nama', 255);
            $table->string('email', 255)->nullable();
            $table->string('no_hp', 50);
            $table->string('alamat', 255)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->enum('status', ['pending', 'process', 'active', 'reject'])->default('pending');

            // timestamps & soft delete
            $table->timestamps();
            $table->softDeletes();

            // Foreign Key ke DataPaket
            $table->foreign('paket_id')
                ->references('id')->on('data_paket')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_clients_regist');
    }
};
