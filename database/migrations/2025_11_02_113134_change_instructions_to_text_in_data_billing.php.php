<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations: change `instructions` from varchar/string to text.
     *
     * @return void
     */
    public function up(): void
    {
        // NOTE: Changing column types requires doctrine/dbal installed.
        Schema::table('data_billing', function (Blueprint $table) {
            // Make sure the column exists; use nullable() to preserve nullability.
            $table->text('instructions')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations: change `instructions` back to string(191).
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            // Revert to string(191). Adjust length if your original length is different.
            $table->string('instructions', 191)->nullable()->change();
        });
    }
};
