<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_clients', function (Blueprint $table) {
            // Lokasi (setelah loc_client)
            $table->string('lat')->nullable()->after('loc_client');
            $table->string('long')->nullable()->after('lat'); // catatan: nama 'long' dibolehkan, dibungkus backtick oleh Laravel

            // Promo (diletakkan setelah tagihan, berderet)
            $table->integer('promo_day')->nullable()->after('tagihan');
            $table->dateTime('promo_day_start')->nullable()->after('promo_day');
            $table->dateTime('promo_day_end')->nullable()->after('promo_day_start');
            $table->boolean('status_promo')->default(false)->after('promo_day_end');
        });
    }

    public function down(): void
    {
        Schema::table('data_clients', function (Blueprint $table) {
            $table->dropColumn([
                'lat',
                'long',
                'promo_day',
                'promo_day_start',
                'promo_day_end',
                'status_promo',
            ]);
        });
    }
};
