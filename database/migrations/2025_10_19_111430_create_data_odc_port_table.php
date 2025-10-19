<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_odc_port', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // FK ke data_odp.id (nama kolom sesuai permintaan: odp_id)
            $table->uuid('odp_id');

            $table->string('port_numb'); // varchar
            $table->enum('status', ['available', 'reserved', 'active', 'faulty', 'blocked'])->default('available');

            $table->timestamps();

            // Foreign key
            $table->foreign('odp_id', 'data_odc_port_odp_id_foreign')
                ->references('id')
                ->on('data_odp')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Opsional tapi direkomendasikan: cegah duplikasi port per ODP
            $table->unique(['odp_id', 'port_numb'], 'data_odc_port_odp_id_port_numb_unique');
        });
    }

    public function down(): void
    {
        Schema::table('data_odc_port', function (Blueprint $table) {
            try {
                $table->dropForeign('data_odc_port_odp_id_foreign');
            } catch (\Throwable $e) {
            }
            try {
                $table->dropUnique('data_odc_port_odp_id_port_numb_unique');
            } catch (\Throwable $e) {
            }
        });

        Schema::dropIfExists('data_odc_port');
    }
};
