<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalAmountAndDiscountToDataBillingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->integer('total_amount')->nullable()->after('amount');
            $table->integer('discount')->nullable()->after('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'discount']);
        });
    }
}
