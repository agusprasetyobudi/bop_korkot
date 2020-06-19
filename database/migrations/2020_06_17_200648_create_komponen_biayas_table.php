<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomponenBiayasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_komponen', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('komponen_biaya');
            $table->integer('read_only')->nullable()->default(0);
            $table->integer('allow_provinsi')->nullable()->default(0);
            $table->integer('allow_korkot')->nullable()->default(0);
            $table->integer('allow_assisten')->nullable()->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_komponen');
    }
}
