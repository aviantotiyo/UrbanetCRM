<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('warehouse')->create('data_item_movements', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('item_id');
            $table->uuid('warehouse_from')->nullable();
            $table->uuid('warehouse_to')->nullable();

            $table->integer('jumlah');
            $table->enum('tipe', ['masuk', 'keluar', 'transfer']);
            $table->string('ref_type')->nullable();

            // Soft-relasi ke database utama (users)
            // $table->unsignedBigInteger('created_by')->nullable();
            $table->uuid('created_by')->nullable();

            $table->timestamp('created_at')->useCurrent();

            // Index untuk performa & query audit
            $table->index('item_id');
            $table->index('warehouse_from');
            $table->index('warehouse_to');
            $table->index('tipe');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::connection('warehouse')->dropIfExists('data_item_movements');
    }
};
