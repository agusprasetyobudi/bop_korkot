<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKantorModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kantor', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kantor');
            $table->foreignId('id_osp');
            $table->foreignId('id_provinsi');
            $table->foreignId('id_kabupaten');
            $table->string('nama_kantor');
            $table->string('nama_kabupaten')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->index('id_osp');
            $table->index('id_provinsi');
            $table->index('id_kabupaten');
            $table->foreign('id_osp')->references('id')->on('master_osp')->onDelete('cascade');
            $table->foreign('id_provinsi')->references('id')->on('master_provinsi')->onDelete('cascade');
            $table->foreign('id_kabupaten')->references('id')->on('master_kabupaten')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *         
     * @return void
     */
    public function down()
    {
        Schema::table('master_kantor', function(Blueprint $table){
            $table->dropForeign('master_kantor_id_osp_foreign');
            $table->dropForeign('master_kantor_id_provinsi_foreign');
            $table->dropForeign('master_kantor_id_kabupaten_foreign');
            $table->dropIndex('master_kantor_id_osp_index');
            $table->dropIndex('master_kantor_id_provinsi_index');
            $table->dropIndex('master_kantor_id_kabupaten_index');
        });
        Schema::dropIfExists('master_kantor');
    }
}
