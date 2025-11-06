<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_clients_prospect', function (Blueprint $table) {
            $table->uuid('paket_id')->nullable()->after('client_id');

            $table->foreign('paket_id')
                ->references('id')
                ->on('data_paket')
                ->nullOnDelete(); // Jika data_paket dihapus, paket_id otomatis NULL
        });
    }

    public function down(): void
    {
        Schema::table('data_clients_prospect', function (Blueprint $table) {
            $table->dropForeign(['paket_id']);
            $table->dropColumn('paket_id');
        });
    }
};
