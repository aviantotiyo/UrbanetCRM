<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->string('reference')->nullable()->change();
            $table->string('payment_method')->nullable()->change();
            $table->string('payment_name')->nullable()->change();
            $table->string('fee_merchant')->nullable()->change();
            $table->string('fee_customer')->nullable()->change();
            $table->string('amount_received')->nullable()->change();
            $table->string('instructions')->nullable()->change();
            $table->string('expired_time')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            //
        });
    }
};
