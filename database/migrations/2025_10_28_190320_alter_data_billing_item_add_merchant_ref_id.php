<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_billing_item', function (Blueprint $table) {
            $table->string('merchant_ref_id')->nullable()->after('id');

            $table->foreign('merchant_ref_id')
                ->references('merchant_ref')
                ->on('data_billing')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_billing_item', function (Blueprint $table) {
            $table->dropForeign(['merchant_ref_id']);
            $table->dropColumn('merchant_ref_id');
        });
    }
};
