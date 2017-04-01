<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Condition', function(Blueprint $table){
            $table->increments('id');


            $table->string('script');

            $table->unsignedInteger('event_type_id')->nullable();
            $table->foreign('event_type_id')->references('id')->on('Event_type');
            $table->string('operator');
            $table->integer('number');


            $table->unsignedInteger('condition_id')->nullable();
            $table->foreign('condition_id')->references('id')->on('Condition');
        });

        Schema::create('Badge_type', function(Blueprint $table){
            $table->increments('id');

            $table->string('name');
            $table->string('picture_url');
            $table->string('description');

            $table->unsignedInteger('event_type_id');
            $table->foreign('event_type_id')->references('id')->on('Event_type');
            $table->string('operator');
            $table->integer('number');

            $table->unsignedInteger('condition_id');
            $table->foreign('condition_id')->references('id')->on('Condition');

            $table->timestamps();
        });

        Schema::create('Players_badge', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('player_id');
            $table->foreign('player_id')->references('id')->on('Player');


            $table->unsignedInteger('badge_type_id');
            $table->foreign('badge_type_id')->references('id')->on('Badge_type');

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
        Schema::dropIfExists('Players_badge');
        Schema::dropIfExists('Badge_type');
        Schema::dropIfExists('Condition');
    }
}
