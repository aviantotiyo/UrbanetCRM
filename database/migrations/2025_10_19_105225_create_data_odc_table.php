<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_odc', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // FK ke data_server.id (nullable), update cascade, delete set null
            $table->uuid('server_id')->nullable();

            $table->string('kode_odc')->unique();
            $table->string('nama_odc')->nullable();
            $table->string('port_cap')->nullable();
            $table->string('port_install')->nullable();
            $table->string('rasio')->nullable();
            $table->string('warna_core')->nullable();
            $table->string('core_cable')->nullable();
            $table->text('note')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();

            // Definisikan FK setelah kolom ada
            $table->foreign('server_id', 'data_odc_server_id_foreign')
                ->references('id')
                ->on('data_server')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_odc', function (Blueprint $table) {
            // Lepas FK jika masih ada
            try {
                $table->dropForeign('data_odc_server_id_foreign');
            } catch (\Throwable $e) {
                // abaikan
            }
        });

        Schema::dropIfExists('data_odc');
    }
};
