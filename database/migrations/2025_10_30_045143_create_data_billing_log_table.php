<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_billing_log', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi ke users
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Relasi ke data_clients
            $table->uuid('client_id');
            $table->foreign('client_id')->references('id')->on('data_clients')->onDelete('cascade');

            // Relasi ke data_billing via merchant_ref
            $table->string('merchant_ref_id');
            $table->foreign('merchant_ref_id')->references('merchant_ref')->on('data_billing')->onDelete('cascade');

            // Status log
            $table->text('status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_billing_log');
    }
};
