<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_odp_port', function (Blueprint $table) {
            // PK UUID
            $table->uuid('id')->primary();

            // FK ke data_odp (wajib)
            $table->uuid('odp_id');
            $table->foreign('odp_id')
                ->references('id')->on('data_odp')
                ->cascadeOnDelete();

            // FK ke data_clients (nullable, karena port bisa 'available' tanpa client)
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')
                ->references('id')->on('data_clients')
                ->nullOnDelete();

            // Nomor port & status
            $table->string('port_numb'); // contoh: 1..N per ODP
            $table->enum('status', ['available', 'reserved', 'active', 'faulty', 'blocked'])
                ->default('available');

            // Audit
            $table->timestamps();

            // Unik: satu nomor port hanya sekali per ODP
            $table->unique(['odp_id', 'port_numb']);

            // Index untuk query umum
            $table->index(['client_id']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_odp_port');
    }
};
