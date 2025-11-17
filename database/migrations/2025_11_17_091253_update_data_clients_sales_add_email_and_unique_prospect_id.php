<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_clients_sales', function (Blueprint $table) {
            // Tambah kolom email setelah no_hp
            $table->string('email')->nullable()->after('no_hp');

            // Tambah unique index ke client_prospect_id
            $table->unique('client_prospect_id');
        });
    }

    public function down(): void
    {
        Schema::table('data_clients_sales', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropUnique(['client_prospect_id']);
        });
    }
};
