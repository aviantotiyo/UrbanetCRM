<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_ticket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ticket_code')->unique();
            $table->uuid('client_id');
            $table->enum('type_task', ['Gangguan', 'Customers Support', 'Support NOC', 'Maintenance']);
            $table->text('detail_task')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['open', 'cancel', 'process', 'finish']);
            $table->dateTime('status_finish')->nullable();
            $table->string('solving')->nullable();
            $table->boolean('ticket_guarantee')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('client_id')
                ->references('id')
                ->on('data_clients')
                ->onDelete('cascade'); // Sesuaikan sesuai kebutuhan (restrict / set null / no action)
        });
    }

    public function down(): void
    {
        Schema::table('data_ticket', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });

        Schema::dropIfExists('data_ticket');
    }
};
