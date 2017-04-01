<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Event_type', function(Blueprint $table){
            $table->increments('id');

            $table->string('name');
            $table->string('description');
            $table->string('text');

            $table->timestamps();
        });

        Schema::create('Players_event', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('player_id');
            $table->foreign('player_id')->references('id')->on('Player');

            $table->unsignedInteger('event_type_id');
            $table->foreign('event_type_id')->references('id')->on('Event_type');

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
        Schema::dropIfExists('Players_event');
        Schema::dropIfExists('Event_type');
    }
}
