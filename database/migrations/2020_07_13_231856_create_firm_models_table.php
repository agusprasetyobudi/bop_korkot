<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm', function (Blueprint $table) {
            $table->id();
            $table->string('no_bukti');
            $table->string('tanggal_tf');
            $table->foreignId('jabatan');
            $table->integer('osp');
            $table->foreignId('kantor');
            $table->string('periode_month');
            $table->string('periode_year');
            $table->string('id_bank');
            $table->string('nama_penerima');
            $table->unsignedBigInteger('bank_account_number');
            $table->string('amount_tf');
            $table->text('description');
            $table->foreignId('created_by');
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
            // $table->index(['created_by','jabatan','kantor']);
            $table->index('created_by');
            $table->index('updated_by');
            $table->index('jabatan');
            $table->index('kantor');
            $table->foreign('jabatan')->references('id')->on('master_jabatan')->onDelete('cascade');
            $table->foreign('kantor')->references('id')->on('master_kantor')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firm', function (Blueprint $table) {
            $table->dropForeign('firm_created_by_foreign');
            $table->dropForeign('firm_updated_by_foreign');
            $table->dropForeign('firm_jabatan_foreign');
            $table->dropForeign('firm_kantor_foreign');
            $table->dropIndex('firm_created_by_index'); 
            $table->dropIndex('firm_updated_by_index'); 
            $table->dropIndex('firm_jabatan_index'); 
            $table->dropIndex('firm_kantor_index'); 
        });
        Schema::dropIfExists('firm');

    }
}
