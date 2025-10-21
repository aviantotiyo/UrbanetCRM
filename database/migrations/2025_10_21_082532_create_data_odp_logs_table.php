<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_odp_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();                    // uuid

            // FK ke data_odp.id (UUID)
            $table->uuid('odp_id')->nullable();
            $table->foreign('odp_id')->references('id')->on('data_odp')
                ->cascadeOnUpdate()->nullOnDelete();

            // FK ke data_odp_port.id (UUID)
            // (nama kolom diminta 'odp_port'; tetap dibuat seperti itu)
            $table->uuid('odp_port')->nullable();
            $table->foreign('odp_port')->references('id')->on('data_odp_port')
                ->cascadeOnUpdate()->nullOnDelete();

            // FK ke data_clients.id (UUID)
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('data_clients')
                ->cascadeOnUpdate()->nullOnDelete();

            $table->text('status');                           // status (text)

            // metadata standar (opsional tapi berguna)
            $table->timestamps();

            // index pendukung query
            $table->index(['odp_id']);
            $table->index(['odp_port']);
            $table->index(['client_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_odp_logs');
    }
};
