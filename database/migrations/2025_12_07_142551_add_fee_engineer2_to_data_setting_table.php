<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeeEngineer2ToDataSettingTable extends Migration
{
    public function up()
    {
        Schema::table('data_setting', function (Blueprint $table) {
            $table->integer('fee_engineer_2')->nullable()->after('fee_engineer');
        });
    }

    public function down()
    {
        Schema::table('data_setting', function (Blueprint $table) {
            $table->dropColumn('fee_engineer_2');
        });
    }
}
