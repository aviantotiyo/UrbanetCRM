<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_csr', function (Blueprint $table) {
            $table->enum('status', ['booking', 'active', 'isolir', 'suspend', 'inactive'])
                ->nullable()
                ->after('odp_port_id');
        });
    }

    public function down(): void
    {
        Schema::table('data_csr', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
