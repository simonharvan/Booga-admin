<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Map_element_type', function(Blueprint $table){
            $table->increments('id');

            $table->string('image_url');
            $table->string('type');
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('Map', function(Blueprint $table){
            $table->increments('id');

            $table->integer('size');
            $table->string('library_position');
        });

        Schema::create('Map_element', function(Blueprint $table){
            $table->increments('id');

            $table->string('position');

            $table->unsignedInteger('map_id');
            $table->foreign('map_id')->references('id')->on('Map');

            $table->unsignedInteger('map_element_type_id');
            $table->foreign('map_element_type_id')->references('id')->on('Map_element_type');

        });

        Schema::create('Players_map', function(Blueprint $table){
            $table->increments('id');

            $table->string('position');

            $table->time('last_book_generated_at');

            $table->unsignedInteger('map_id');
            $table->foreign('map_id')->references('id')->on('Map');
        });

        Schema::table('Player', function (Blueprint $table) {
            $table->unsignedInteger('players_map_id')->after('id');
            $table->foreign('players_map_id')->references('id')->on('Players_map');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Player', function (Blueprint $table) {
            $table->dropForeign(['players_map_id']);
            $table->dropColumn('players_map_id');
        });
        Schema::dropIfExists('Map_element');
        Schema::dropIfExists('Map_element_type');
        Schema::dropIfExists('Players_map');
        Schema::dropIfExists('Map');
        Schema::dropIfExists('Minions_on_map');


    }
}
