<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_paket', function (Blueprint $table) {
            $table->string('ip_pool')->nullable()->after('limit_radius');
        });
    }

    public function down(): void
    {
        Schema::table('data_paket', function (Blueprint $table) {
            $table->dropColumn('ip_pool');
        });
    }
};
