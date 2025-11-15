<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaketIdToDataClientsPartnerTable extends Migration
{
    public function up(): void
    {
        Schema::table('data_clients_partner', function (Blueprint $table) {
            $table->uuid('paket_id')->after('partner_id');

            $table->foreign('paket_id')
                ->references('id')->on('data_paket')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('data_clients_partner', function (Blueprint $table) {
            $table->dropForeign(['paket_id']);
            $table->dropColumn('paket_id');
        });
    }
}
