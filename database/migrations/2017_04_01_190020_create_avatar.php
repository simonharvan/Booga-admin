<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvatar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Avatar_type', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('image_url');
            $table->string('description');

            $table->timestamps();
        });

        Schema::create('Avatar', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('avatar_type_id');
            $table->foreign('avatar_type_id')->references('id')->on('Avatar_type');

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
        Schema::dropIfExists('Avatar');
        Schema::dropIfExists('Avatar_type');
    }
}
