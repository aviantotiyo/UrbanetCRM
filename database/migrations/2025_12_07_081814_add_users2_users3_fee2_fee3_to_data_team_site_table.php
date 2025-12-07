<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsers2Users3Fee2Fee3ToDataTeamSiteTable extends Migration
{
    public function up()
    {
        Schema::table('data_team_site', function (Blueprint $table) {

            // ---- UBAH DARI BIGINT → UUID ----
            $table->uuid('users_id_2')->nullable()->after('users_id');
            $table->uuid('users_id_3')->nullable()->after('users_id_2');

            $table->foreign('users_id_2')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('users_id_3')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            // fee 2 & 3
            $table->integer('fee_2')->nullable()->after('fee');
            $table->integer('fee_3')->nullable()->after('fee_2');
        });
    }

    public function down()
    {
        Schema::table('data_team_site', function (Blueprint $table) {
            $table->dropForeign(['users_id_2']);
            $table->dropForeign(['users_id_3']);
            $table->dropColumn(['users_id_2', 'users_id_3', 'fee_2', 'fee_3']);
        });
    }
}
