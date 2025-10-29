<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom soft delete.
     */
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->softDeletes()->after('billing_paid'); // otomatis menambah kolom deleted_at
        });
    }

    /**
     * Rollback perubahan.
     */
    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
