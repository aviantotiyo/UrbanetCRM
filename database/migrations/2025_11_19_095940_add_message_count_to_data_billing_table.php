<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->integer('message_count')
                ->nullable()
                ->default(0)
                ->after('bank_check');
        });
    }

    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->dropColumn('message_count');
        });
    }
};
