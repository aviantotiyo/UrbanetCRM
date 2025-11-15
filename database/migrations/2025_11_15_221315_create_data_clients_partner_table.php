<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataClientsPartnerTable extends Migration
{
    public function up(): void
    {
        Schema::create('data_clients_partner', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('partner_id');
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->enum('status', ['pending', 'process', 'active', 'reject']);
            $table->uuid('client_prospect_id')->index();
            $table->integer('fee')->nullable();;
            $table->boolean('fee_paid')->default(0);
            $table->dateTime('fee_date_paid')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('partner_id')
                ->references('id')->on('data_partner')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_clients_partner');
    }
}
