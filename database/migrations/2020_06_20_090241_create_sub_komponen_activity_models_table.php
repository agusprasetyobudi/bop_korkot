<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKomponenActivityModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_aktifitas_subkomponen', function (Blueprint $table) {
            $table->id();
            // $table->integer('id_subkomponen');
            // $table->integer('id_aktifitas');
            $table->foreignId('id_subkomponen');
            $table->foreignId('id_aktifitas');
            $table->index('id_subkomponen');
            $table->index('id_aktifitas');
            $table->foreign('id_subkomponen')->references('id')->on('master_komponen')->onDelete('cascade');
            $table->foreign('id_aktifitas')->references('id')->on('master_aktifitas')->onDelete('cascade');
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
        Schema::table('master_aktifitas_subkomponen', function(Blueprint $table){
            $table->dropForeign('master_aktifitas_subkomponen_id_subkomponen_foreign');
            $table->dropForeign('master_aktifitas_subkomponen_id_aktifitas_foreign'); 
            $table->dropIndex('master_aktifitas_subkomponen_id_subkomponen_index');
            $table->dropIndex('master_aktifitas_subkomponen_id_aktifitas_index'); 
        });
        Schema::dropIfExists('master_aktifitas_subkomponen');
    }
}
