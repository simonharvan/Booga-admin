<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Player', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nick');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('energy');
            $table->integer('points');
            $table->integer('detective');
            $table->integer('fantasy');
            $table->integer('horor');
            $table->integer('traveling');
            $table->integer('romance');
            $table->integer('scifi');
            $table->integer('drama');
            $table->integer('fairytale');

            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();

        });

        Schema::table('Obtained_book', function (Blueprint $table) {
            $table->unsignedInteger('player_id')->after('id');
            $table->foreign('player_id')->references('id')->on('Player');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Obtained_book', function (Blueprint $table) {
            $table->dropForeign(['player_id']);
            $table->dropColumn('player_id');
        });
//        Schema::dropIfExists('Event_type');
        Schema::dropIfExists('Player');
    }
}
