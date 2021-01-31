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
            $table->foreignId('id_parent_transfer')->nullable();            
            $table->integer('jumlah');            
            $table->foreignId('created_by');           
            $table->timestamps();
            $table->index('id_item_transfer');
            $table->index('id_parent_transfer');
            $table->index('created_by');
            $table->foreign('id_item_transfer')->references('id')->on('transfer')->onDelete('cascade');
            $table->foreign('id_parent_transfer')->references('id')->on('transfer')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropForeign('pengeluaran_created_by_foreign');
            $table->dropForeign('pengeluaran_id_item_transfer_foreign');
            $table->dropForeign('pengeluaran_id_parent_transfer_foreign');
            $table->dropIndex('pengeluaran_id_item_transfer_index');
            $table->dropIndex('pengeluaran_id_parent_transfer_index');
            $table->dropIndex('pengeluaran_created_by_index');
        });
        Schema::drop('pengeluaran');
    }
}
