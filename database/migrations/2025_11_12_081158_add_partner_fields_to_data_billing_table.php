<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->integer('kode_unik')->nullable()->after('billing_paid');
            $table->string('bank_name_manual')->nullable()->after('kode_unik');
            $table->dateTime('exp_tx_bank')->nullable()->after('bank_name_manual');
            $table->uuid('partner_id')->nullable()->after('exp_tx_bank');
            $table->string('bank_check')->nullable()->after('partner_id');

            // 🔗 Tambahkan foreign key ke data_partner
            $table->foreign('partner_id')->references('id')->on('data_partner')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->dropForeign(['partner_id']);
            $table->dropColumn([
                'kode_unik',
                'bank_name_manual',
                'exp_tx_bank',
                'partner_id',
                'bank_check'
            ]);
        });
    }
};
