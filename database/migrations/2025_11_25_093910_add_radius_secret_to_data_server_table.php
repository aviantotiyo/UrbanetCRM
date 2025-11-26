<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_server', function (Blueprint $table) {
            $table->string('radius_secret')->nullable()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('data_server', function (Blueprint $table) {
            $table->dropColumn('radius_secret');
        });
    }
};
