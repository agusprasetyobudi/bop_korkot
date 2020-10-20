<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKabupatenModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinsi_id');
            $table->string('kabupaten_name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->index('provinsi_id');
            $table->foreign('provinsi_id')->references('id')->on('master_provinsi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_kabupaten', function (Blueprint $table) {
            $table->dropIndex('master_kabupaten_provinsi_id_index');
            $table->dropForeign('master_kabupaten_provinsi_id_foreign');
        });
        Schema::dropIfExists('master_kabupaten');
    }
}
