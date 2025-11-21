<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankFieldsToDataPartnerTable extends Migration
{
    public function up()
    {
        Schema::table('data_partner', function (Blueprint $table) {
            $table->string('bank_name')->nullable()->after('status');
            $table->string('bank_pic')->nullable()->after('bank_name');
            $table->string('bank_account')->nullable()->after('bank_pic'); // ← ini saya anggap sebagai no rekening
        });
    }

    public function down()
    {
        Schema::table('data_partner', function (Blueprint $table) {
            $table->dropColumn(['bank_name', 'bank_pic', 'bank_account']);
        });
    }
}
