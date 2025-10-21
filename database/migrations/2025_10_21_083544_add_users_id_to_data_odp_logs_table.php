<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_odp_logs', function (Blueprint $table) {
            // Tambah kolom users_id (UUID) setelah kolom id
            $table->uuid('users_id')->nullable()->after('id');

            // Buat FK ke users.id
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Index tambahan (opsional, bantu query)
            $table->index('users_id');
        });
    }

    public function down(): void
    {
        Schema::table('data_odp_logs', function (Blueprint $table) {
            // Lepas FK & kolom saat rollback
            $table->dropForeign(['users_id']);
            $table->dropIndex(['users_id']);
            $table->dropColumn('users_id');
        });
    }
};
