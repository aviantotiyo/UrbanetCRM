<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeePaidColumnsToDataTeamSiteTable extends Migration
{
    public function up()
    {
        Schema::table('data_team_site', function (Blueprint $table) {

            // Tambahkan kolom boolean fee paid
            $table->boolean('fee_paid')
                ->default(0)
                ->after('fee_3');

            $table->boolean('fee_paid_2')
                ->default(0)
                ->after('fee_paid');

            $table->boolean('fee_paid_3')
                ->default(0)
                ->after('fee_paid_2');

            // Tambahkan kolom tanggal pembayaran
            $table->dateTime('fee_paid_at')
                ->nullable()
                ->after('fee_paid_3');

            $table->dateTime('fee2_paid_at')
                ->nullable()
                ->after('fee_paid_at');

            $table->dateTime('fee3_paid_at')
                ->nullable()
                ->after('fee2_paid_at');
        });
    }

    public function down()
    {
        Schema::table('data_team_site', function (Blueprint $table) {
            $table->dropColumn([
                'fee_paid',
                'fee_paid_2',
                'fee_paid_3',
                'fee_paid_at',
                'fee2_paid_at',
                'fee3_paid_at',
            ]);
        });
    }
}
