<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_client_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('users_id');
            $table->uuid('client_id');
            $table->text('status');
            $table->timestamps();

            // Foreign keys
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('data_clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_client_logs');
    }
};
