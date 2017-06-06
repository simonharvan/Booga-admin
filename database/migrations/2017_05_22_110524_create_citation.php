<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Citation', function (Blueprint $table) {
            $table->increments('id');

            $table->string('text');
            $table->string('author');
            $table->integer('from');
            $table->integer('to');

            $table->unsignedInteger('genre_id')->nullable();
            $table->foreign('genre_id')->references('id')->on('Genre');

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
        Schema::dropIfExists('Citation');
    }
}
