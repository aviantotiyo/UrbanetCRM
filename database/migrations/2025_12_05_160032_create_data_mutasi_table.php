<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_mutasi', function (Blueprint $table) {

            // UUID sebagai Primary Key
            $table->uuid('id')->primary();

            $table->string('mutation_id')->unique();
            $table->string('account_number');
            $table->string('bank');
            $table->string('bank_name');
            $table->string('type');
            $table->string('description');
            $table->string('amount');
            $table->string('balance');
            $table->dateTime('date')->nullable();

            $table->unsignedInteger('mutasi_check')->nullable();
            $table->dateTime('mutasi_check_time')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_mutasi');
    }
};
