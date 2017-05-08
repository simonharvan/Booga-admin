<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteMapper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Real_library', function(Blueprint $table){
            $table->dropForeign(['mapper_id']);
            $table->dropColumn('mapper_id');
        });

        Schema::dropIfExists('Library_mapper');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('Library_mapper', function (Blueprint $table) {
            $table->increments('id');

            $table->string('format');
        });

        Schema::table('Real_library', function(Blueprint $table){

            $table->unsignedInteger('mapper_id')->nullable();
            $table->foreign('mapper_id')->references('id')->on('Library_mapper');
        });

    }
}
