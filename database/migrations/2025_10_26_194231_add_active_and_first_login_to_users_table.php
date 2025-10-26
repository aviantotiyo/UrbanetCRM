<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->default(0)->after('role');
            $table->boolean('is_first_login')->default(0)->after('active');
            $table->softDeletes()->after('remember_token'); // Menambahkan kolom deleted_at
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['active', 'is_first_login', 'deleted_at']);
        });
    }
};
