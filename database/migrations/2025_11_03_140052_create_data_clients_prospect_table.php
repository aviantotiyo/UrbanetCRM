<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_clients_prospect', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('client_id');
            $table->foreign('client_id')->references('id')->on('data_clients')->onDelete('cascade');

            $table->string('nama');
            $table->string('no_hp');
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();

            $table->integer('point')->default(0);

            $table->enum('status', ['pending', 'process', 'active', 'reject'])->default('pending');

            $table->uuid('client_prospect_id')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_clients_prospect');
    }
};
