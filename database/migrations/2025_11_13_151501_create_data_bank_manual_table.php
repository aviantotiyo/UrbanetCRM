<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('data_bank_manual', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nama_bank');
            $table->string('nama_pic');
            $table->string('no_rek');

            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_bank_manual');
    }
};
