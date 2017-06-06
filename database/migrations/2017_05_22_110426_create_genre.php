<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Genre', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('description');

            $table->timestamps();
        });

        Schema::table('Book_type', function (Blueprint $table) {

            $table->unsignedInteger('genre_id')->nullable();
            $table->foreign('genre_id')->references('id')->on('Genre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Book_type', function (Blueprint $table) {
            $table->dropForeign('genre_id');
            $table->dropColumn('genre_id');
        });
        Schema::dropIfExists('Genre');

    }
}
