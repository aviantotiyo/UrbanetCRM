<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: tambahkan kolom 'denda' ke tabel data_billing_item.
     */
    public function up(): void
    {
        Schema::table('data_billing_item', function (Blueprint $table) {
            $table->integer('denda')->nullable()->after('discount');
        });
    }

    /**
     * Batalkan migrasi (rollback).
     */
    public function down(): void
    {
        Schema::table('data_billing_item', function (Blueprint $table) {
            $table->dropColumn('denda');
        });
    }
};
