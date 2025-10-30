<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_team_site', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi ke users
            $table->uuid('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            // Relasi opsional ke data_ticket_hc
            $table->uuid('data_ticket_hc_id')->nullable();
            $table->foreign('data_ticket_hc_id')->references('id')->on('data_ticket_hc')->onDelete('set null');

            // Relasi opsional ke data_ticket
            $table->uuid('data_ticket_id')->nullable();
            $table->foreign('data_ticket_id')->references('id')->on('data_ticket')->onDelete('set null');

            // Relasi opsional ke data_clients
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('data_clients')->onDelete('set null');

            // Fee team site
            $table->integer('fee')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_team_site');
    }
};
