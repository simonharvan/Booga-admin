<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Profile', function(Blueprint $table){
            $table->increments('id');

            $table->string('provider_id');
            $table->string('provider_name');
            $table->string('avatar_url');
            $table->string('name');

            $table->timestamps();
        });

        Schema::table('Player', function(Blueprint $table){

            $table->unsignedInteger('profile_id')->after('id');
            $table->foreign('profile_id')->references('id')->on('Profile');
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
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');
        });
        Schema::dropIfExists('Profile');
    }
}
