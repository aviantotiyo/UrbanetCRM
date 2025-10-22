<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDendaAndAfterTaxToDataBillingTable extends Migration
{
    public function up(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->integer('denda')->nullable()->after('instructions');
            $table->integer('after_tax')->nullable()->after('denda');
        });
    }

    public function down(): void
    {
        Schema::table('data_billing', function (Blueprint $table) {
            $table->dropColumn(['denda', 'after_tax']);
        });
    }
}
