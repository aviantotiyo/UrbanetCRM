<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_billing', function (Blueprint $table) {
            // Pastikan kolom client_id memang ada; menambahkan kolom boolean setelah client_id
            $table->boolean('new_member')->default(false)->after('client_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('data_billing', function (Blueprint $table) {
            // safe drop: cek kalau kolom ada sebelum drop (opsional)
            if (Schema::hasColumn('data_billing', 'new_member')) {
                $table->dropColumn('new_member');
            }
        });
    }
};
