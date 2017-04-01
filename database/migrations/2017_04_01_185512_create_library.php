<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Library', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
        });

        Schema::table('Player', function(Blueprint $table){

            $table->unsignedInteger('library_id');
            $table->foreign('library_id')->references('id')->on('Library');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Player', function(Blueprint $table){
            $table->dropForeign(['library_id']);
            $table->dropColumn('library_id');
        });
        Schema::dropIfExists('Library');
    }
}
