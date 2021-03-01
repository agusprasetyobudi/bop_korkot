<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuBankModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_bank', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->foreignId('id_firm');
            $table->foreignId('id_item_transfer');
            $table->foreignId('created_by');
            $table->timestamp('created_at');
            $table->foreignId('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('id_firm')->references('id')->on('firm')->onDelete('cascade');
            $table->foreign('id_item_transfer')->references('id')->on('transfer')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->index('id_firm');
            $table->index('id_item_transfer');
            $table->index('created_by');
            $table->index('updated_by');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buku_bank', function (Blueprint $table) {
            $table->dropForeign('buku_bank_id_firm_foreign');
            $table->dropForeign('buku_bank_id_item_transfer_foreign');
            $table->dropForeign('buku_bank_created_by_foreign');
            $table->dropForeign('buku_bank_updated_by_foreign');
            $table->dropIndex('buku_bank_id_firm_index');
            $table->dropIndex('buku_bank_id_item_transfer_index');
            $table->dropIndex('buku_bank_created_by_index');
            $table->dropIndex('buku_bank_updated_by_index');
        });
        Schema::dropIfExists('buku_bank');
    }
}
