<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah tipe kolom jadi UUID
        Schema::table('data_clients', function (Blueprint $table) {
            $table->uuid('odp_id')->nullable()->change();
            $table->uuid('odp_port_id')->nullable()->change();
        });

        // Tambahkan foreign key constraint
        Schema::table('data_clients', function (Blueprint $table) {
            $table->foreign('odp_id')->references('id')->on('data_odp')->onDelete('set null');
            $table->foreign('odp_port_id')->references('id')->on('data_odp_port')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_clients', function (Blueprint $table) {
            $table->dropForeign(['odp_id']);
            $table->dropForeign(['odp_port_id']);

            $table->string('odp_id')->nullable()->change();
            $table->string('odp_port_id')->nullable()->change();
        });
    }
};
