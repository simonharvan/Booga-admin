<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Minion_type', function(Blueprint $table){
            $table->increments('id');

            $table->string('name');
            $table->string('image_url');
            $table->integer('strength');

            $table->timestamps();
        });

        Schema::create('Minions_on_map', function(Blueprint $table){
            $table->increments('id');

            $table->string('position');

            $table->unsignedInteger('minion_type_id');
            $table->foreign('minion_type_id')->references('id')->on('Minion_type');

            $table->unsignedInteger('players_map_id');
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
        Schema::dropIfExists('Minions_on_map');
        Schema::dropIfExists('Minion_type');
    }
}
