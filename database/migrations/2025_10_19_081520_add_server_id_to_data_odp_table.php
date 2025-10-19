<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_odp', function (Blueprint $table) {
            // Tambah kolom server_id setelah kode_odp
            $table->uuid('server_id')->nullable()->after('kode_odp');

            // Foreign key ke data_server(id)
            $table->foreign('server_id', 'data_odp_server_id_foreign')
                ->references('id')
                ->on('data_server')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_odp', function (Blueprint $table) {
            // Lepas FK lalu drop kolom
            $table->dropForeign('data_odp_server_id_foreign');
            $table->dropColumn('server_id');
        });
    }
};
