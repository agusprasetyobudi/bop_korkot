<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_firms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_firm');
            $table->foreignId('updated_by');
            $table->string('type_log');
            $table->timestamps();
            $table->index('id_firm');
            $table->index('updated_by');
            $table->foreign('id_firm')->references('id')->on('firm')->onDelete('cascade');
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
        Schema::table('log_firms', function (Blueprint $table) {
            $table->dropForeign('log_firms_id_firm_foreign');
            $table->dropForeign('log_firms_updated_by_foreign');
            $table->dropIndex('log_firms_id_firm_index'); 
            $table->dropIndex('log_firms_updated_by_index'); 
        });
        Schema::dropIfExists('log_firms');
    }
}
