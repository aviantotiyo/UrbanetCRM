<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('warehouse')->create('data_warehouse_stocks', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Foreign keys
            $table->uuid('warehouse_id');
            $table->uuid('item_id');
            $table->uuid('category_id');

            // Stock details
            $table->integer('jumlah')->default(0);
            $table->string('kode_rak')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('warehouse_id')->references('id')->on('data_warehouses')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('data_items')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('data_categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::connection('warehouse')->dropIfExists('data_warehouse_stocks');
    }
};
