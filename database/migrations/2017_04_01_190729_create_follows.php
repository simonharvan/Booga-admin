<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Player_follows_Player', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('followed_by_player');
            $table->foreign('followed_by_player')->references('id')->on('Player');

            $table->unsignedInteger('following_player_id');
            $table->foreign('following_player_id')->references('id')->on('Player');

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
        Schema::dropIfExists('Player_follows_Player');
    }
}
