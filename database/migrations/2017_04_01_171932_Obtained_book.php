<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ObtainedBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("Obtained_book", function (Blueprint $table) {
            $table->increments('id');

            $table->integer('main_idea');
            $table->boolean('placed');
            $table->boolean('read');


            $table->unsignedInteger('book_type_id');
            $table->foreign('book_type_id')->references('id')->on('Book_type');

            $table->timestamps();
        });

        Schema::create("Identify_text_quiz_answer", function (Blueprint $table) {
            $table->increments('id');

            $table->string('answered_text');
            $table->integer('points_obtained');

            $table->unsignedInteger('obtained_book_id');
            $table->foreign('obtained_book_id')->references('id')->on('Obtained_book');
        });

        Schema::create("Identify_character_quiz_answer", function (Blueprint $table) {
            $table->increments('id');

            $table->string('answers');
            $table->integer('points_obtained');

            $table->unsignedInteger('obtained_book_id');
            $table->foreign('obtained_book_id')->references('id')->on('Obtained_book');
        });

        Schema::create("Mini_quiz_result", function (Blueprint $table) {
            $table->increments('id');

            $table->string('question');
            $table->integer('points_obtained');

            $table->unsignedInteger('obtained_book_id');
            $table->foreign('obtained_book_id')->references('id')->on('Obtained_book');
        });

        Schema::create("Mini_quiz_answer", function (Blueprint $table) {
            $table->increments('id');

            $table->string('answers');

            $table->unsignedInteger('mini_quiz_result_id');
            $table->foreign('mini_quiz_result_id')->references('id')->on('Mini_quiz_result');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Mini_quiz_answer');
        Schema::dropIfExists('Mini_quiz_result');
        Schema::dropIfExists('Identify_character_quiz_answer');
        Schema::dropIfExists('Identify_text_quiz_answer');
        Schema::dropIfExists('Obtained_book');

    }
}
