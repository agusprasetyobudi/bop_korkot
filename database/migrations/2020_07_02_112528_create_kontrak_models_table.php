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
            $table->foreignId('id_komponen')->nullable();
            $table->foreignId('id_sub_komponen')->nullable();
            $table->foreignId('id_subkomponen_aktifitas')->nullable();
            $table->string('kode_kontrak')->nullable();
            $table->foreignId('id_kantor')->nullable();
            $table->foreignId('id_osp')->nullable();
            $table->integer('nominal')->nullable();
            $table->foreignId('provinsi_asal')->nullable();
            $table->foreignId('provinsi_tujuan')->nullable();
            $table->foreignId('kabupaten_asal')->nullable();
            $table->foreignId('kabupaten_tujuan')->nullable();
            $table->string('kabupaten_asal_value')->nullable();
            $table->string('kabupaten_tujuan_value')->nullable();
            $table->string('tanggal_kontrak')->nullable();
            $table->string('tanggal_kontrak_mulai')->nullable();
            $table->string('tanggal_kontrak_akhir')->nullable();
            $table->string('start_periode')->nullable();
            $table->string('end_periode')->nullable();
            $table->foreignId('id_amandemen')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->index('id_komponen');
            $table->index('id_sub_komponen');
            $table->index('id_subkomponen_aktifitas');
            $table->index('id_kantor');
            $table->index('id_osp');
            $table->index('provinsi_asal');
            $table->index('provinsi_tujuan');
            $table->index('kabupaten_asal');
            $table->index('kabupaten_tujuan');
            $table->index('id_amandemen');
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
