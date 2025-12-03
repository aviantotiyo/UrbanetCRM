<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_csr', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nopel')->unique();
            $table->string('nama');
            $table->text('detail_pic')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('loc_client')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('paket')->nullable();
            $table->string('foto_depan')->nullable();
            $table->string('user_pppoe')->unique();
            $table->string('pass_pppoe');
            $table->string('name_profile')->nullable();
            $table->string('limit_radius')->nullable();

            // Foreign Keys
            $table->uuid('odp_id')->nullable();
            $table->uuid('odp_port_id')->nullable();

            $table->foreign('odp_id')->references('id')->on('data_odp')->nullOnDelete();
            $table->foreign('odp_port_id')->references('id')->on('data_odp_port')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_csr');
    }
};

