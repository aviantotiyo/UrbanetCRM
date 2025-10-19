<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_odp', function (Blueprint $table) {
            // Tambahkan kolom VLAN (string). Nullable agar aman untuk data lama.
            $table->string('vlan')->nullable()->after('port_install');
        });
    }

    public function down(): void
    {
        Schema::table('data_odp', function (Blueprint $table) {
            $table->dropColumn('vlan');
        });
    }
};
