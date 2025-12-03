<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_odp_port', function (Blueprint $table) {
            $table->uuid('client_csr_id')
                ->nullable()
                ->after('client_id');

            $table->foreign('client_csr_id')
                ->references('id')
                ->on('data_csr')
                ->nullOnDelete(); // jika data CSR dihapus → set NULL
        });
    }

    public function down(): void
    {
        Schema::table('data_odp_port', function (Blueprint $table) {
            $table->dropForeign(['client_csr_id']);
            $table->dropColumn('client_csr_id');
        });
    }
};
