<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_ticket_hc', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ticket_code')->unique();
            $table->uuid('client_id');
            $table->text('note');
            $table->enum('status', ['open', 'process', 'pending', 'cancel', 'finish']);
            $table->string('merk_kabel')->nullable();
            $table->string('panjang_kabel')->nullable();
            $table->string('sambungan_kabel')->nullable();
            $table->dateTime('status_finish')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint ke data_clients
            $table->foreign('client_id')
                ->references('id')
                ->on('data_clients')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('data_ticket_hc', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });

        Schema::dropIfExists('data_ticket_hc');
    }
};
