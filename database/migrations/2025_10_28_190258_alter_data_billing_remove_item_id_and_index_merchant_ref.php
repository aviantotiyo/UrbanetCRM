<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            // Hapus kolom item_id
            if (Schema::hasColumn('data_billing', 'item_id')) {
                $table->dropForeign(['item_id']);
                $table->dropColumn('item_id');
            }

            // Jadikan merchant_ref indexed + unique agar bisa jadi FK target
            $table->unique('merchant_ref', 'merchant_ref_unique');
        });
    }

    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->uuid('item_id')->nullable()->after('client_id');

            // Jika ada FK sebelumnya
            $table->foreign('item_id')
                ->references('id')
                ->on('data_billing_item')
                ->onDelete('set null');

            $table->dropUnique('merchant_ref_unique');
        });
    }
};
