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
            $table->string('id_osp');
            $table->string('id_provinsi');
            $table->string('id_kabupaten');
            $table->string('nama_kantor');
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
        Schema::dropIfExists('master_kantor');
    }
}
