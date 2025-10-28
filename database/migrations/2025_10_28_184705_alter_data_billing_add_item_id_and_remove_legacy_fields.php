<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            // Tambahkan kolom baru item_id setelah client_id
            $table->uuid('item_id')->nullable()->after('client_id');

            // Foreign Key ke data_billing_item
            $table->foreign('item_id')
                ->references('id')
                ->on('data_billing_item')
                ->onDelete('set null');

            // Hapus kolom lama yang tidak diperlukan
            $table->dropColumn(['amount', 'discount', 'sku', 'name', 'denda', 'billing_cycle']);
        });
    }

    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            // Kembalikan kolom lama
            $table->integer('amount')->nullable();
            $table->integer('discount')->nullable();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->integer('denda')->nullable();
            $table->dateTime('billing_cycle')->nullable();

            // Hapus foreign key & kolom item_id
            $table->dropForeign(['item_id']);
            $table->dropColumn('item_id');
        });
    }
};
