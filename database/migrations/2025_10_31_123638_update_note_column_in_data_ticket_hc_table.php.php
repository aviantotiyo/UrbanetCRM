<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNoteColumnInDataTicketHcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_ticket_hc', function (Blueprint $table) {
            // Mengubah kolom 'note' menjadi nullable
            $table->text('note')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_ticket_hc', function (Blueprint $table) {
            // Mengembalikan kolom 'note' menjadi tidak nullable
            $table->text('note')->nullable(false)->change();
        });
    }
}
