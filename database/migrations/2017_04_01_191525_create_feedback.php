<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Feedback', function(Blueprint $table){
            $table->increments('id');

            $table->string('message');
            $table->string('type');
            $table->boolean('solved');

            $table->unsignedInteger('player_id');
            $table->foreign('player_id')->references('id')->on('Player');

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
        Schema::dropIfExists('Feedback');
    }
}
