<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: tambahkan kolom tax ke tabel data_billing.
     */
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->integer('tax')->nullable()->after('after_tax');
        });
    }

    /**
     * Batalkan migrasi (rollback).
     */
    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->dropColumn('tax');
        });
    }
};
