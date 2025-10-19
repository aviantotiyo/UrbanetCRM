<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_odc_port', function (Blueprint $table) {
            // Tambah kolom odc_id setelah id
            $table->uuid('odc_id')->nullable()->after('id');

            // Foreign key ke data_odc(id)
            $table->foreign('odc_id', 'data_odc_port_odc_id_foreign')
                ->references('id')
                ->on('data_odc')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_odc_port', function (Blueprint $table) {
            // Lepas FK lalu drop kolom
            try {
                $table->dropForeign('data_odc_port_odc_id_foreign');
            } catch (\Throwable $e) {
                // abaikan jika sudah terhapus
            }
            $table->dropColumn('odc_id');
        });
    }
};
