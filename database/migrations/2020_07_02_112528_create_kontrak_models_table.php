<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->integer('id_komponen')->nullable();
            $table->integer('id_sub_komponen')->nullable();
            $table->integer('id_subkomponen_aktifitas')->nullable();
            $table->string('kode_kontrak')->nullable();
            $table->string('id_kantor')->nullable();
            $table->string('id_osp')->nullable();
            $table->integer('nominal')->nullable();
            $table->string('provinsi_asal')->nullable();
            $table->string('provinsi_tujuan')->nullable();
            $table->string('kabupaten_asal')->nullable();
            $table->string('kabupaten_tujuan')->nullable();
            $table->string('tanggal_kontrak')->nullable();
            $table->string('tanggal_kontrak_mulai')->nullable();
            $table->string('tanggal_kontrak_akhir')->nullable();
            $table->string('start_periode')->nullable();
            $table->string('end_periode')->nullable();
            $table->string('id_amandemen')->nullable();
            $table->string('amandemen')->nullable();
            $table->string('amandement_flg')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrak');
    }
}
