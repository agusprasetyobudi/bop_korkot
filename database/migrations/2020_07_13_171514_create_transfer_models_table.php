<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->foreignId('firm_id')->nullable();
            $table->foreignId('item_kontrak_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('amount_item')->nullable();
            $table->date('tanngal_terima')->nullable();
            $table->foreignId('created_by');
            $table->index('parent_id');
            $table->index('firm_id');
            $table->index('item_kontrak_id');
            $table->foreign('firm_id')->references('id')->on('firm')->onDelete('cascade');
            $table->foreign('item_kontrak_id')->references('id')->on('kontrak')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer', function (Blueprint $table) {
            $table->dropForeign('transfer_firm_id_foreign');
            $table->dropForeign('transfer_item_kontrak_id_foreign'); 
            $table->dropForeign('transfer_created_by_foreign');  
            $table->dropIndex('transfer_firm_id_index');
            $table->dropIndex('transfer_parent_id_index');
            $table->dropIndex('transfer_item_kontrak_id_index'); 
        });
        Schema::dropIfExists('transfer');
    }
}
