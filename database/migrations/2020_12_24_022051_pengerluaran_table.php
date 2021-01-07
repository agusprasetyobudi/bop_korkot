<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PengerluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_item_transfer');            
            $table->integer('jumlah');            
            $table->timestamps();
            $table->index('id_item_transfer');
            $table->foreign('id_item_transfer')->references('id')->on('transfer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengeluaran', function (Blueprint $table) {
            $table->dropForeign('pengeluaran_id_item_transfer_foreign');
            $table->dropIndex('pengeluaran_id_item_transfer_index');
        });
        Schema::drop('pengeluaran');
    }
}
