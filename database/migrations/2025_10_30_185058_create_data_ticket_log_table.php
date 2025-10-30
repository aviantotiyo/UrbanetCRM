<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_ticket_log', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi opsional ke data_ticket_hc
            $table->uuid('data_ticket_hc_id')->nullable();
            $table->foreign('data_ticket_hc_id')
                ->references('id')
                ->on('data_ticket_hc')
                ->onDelete('set null');

            // Relasi opsional ke data_ticket
            $table->uuid('data_ticket_id')->nullable();
            $table->foreign('data_ticket_id')
                ->references('id')
                ->on('data_ticket')
                ->onDelete('set null');

            $table->text('status'); // catatan atau status log

            $table->timestamps();
            $table->softDeletes(); // untuk fitur soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_ticket_log');
    }
};
