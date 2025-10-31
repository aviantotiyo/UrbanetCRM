<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_img', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('client_id');
            $table->foreign('client_id')->references('id')->on('data_clients')->onDelete('cascade');

            $table->uuid('data_ticket_hc_id')->nullable();
            $table->foreign('data_ticket_hc_id')->references('id')->on('data_ticket_hc')->onDelete('cascade');

            $table->uuid('data_ticket_id')->nullable();
            $table->foreign('data_ticket_id')->references('id')->on('data_ticket')->onDelete('cascade');

            $table->string('url_img');
            $table->string('tag')->nullable();

            $table->softDeletes(); // soft delete
            $table->timestamps();  // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_img');
    }
};
