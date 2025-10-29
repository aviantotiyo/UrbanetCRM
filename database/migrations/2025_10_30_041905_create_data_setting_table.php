<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_setting', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('denda')->nullable();
            $table->integer('point')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('fee_merchant_billing')->nullable();
            $table->integer('fee_merchant_sales')->nullable();
            $table->integer('fee_sales_internal')->nullable();
            $table->integer('fee_engineer_sales')->nullable();
            $table->integer('fee_engineer')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_setting');
    }
};
