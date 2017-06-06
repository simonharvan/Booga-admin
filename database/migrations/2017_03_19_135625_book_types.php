<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Identify_character_quiz', function (Blueprint $table) {
            $table->increments('id');

            $table->string('answers');
            $table->string('correct_answers');
            $table->integer('max_points_obtain');
            $table->integer('unlock_rate');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('Identify_character_quiz_hint', function (Blueprint $table) {
            $table->increments('id');

            $table->string('text');
            $table->integer('time_to_answer');


            $table->unsignedInteger('identify_character_quiz_id')->nullable();
            $table->foreign('identify_character_quiz_id')->references('id')->on('Identify_character_quiz');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('Mini_quiz', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('energy_loss');
            $table->integer('bonus_points');
            $table->integer('unlock_rate');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('Mini_quiz_question', function (Blueprint $table) {
            $table->increments('id');

            $table->string('question');
            $table->string('answers');
            $table->string('correct_answers');
            $table->integer('time_to_answer');
            $table->integer('points_to_obtain');


            $table->unsignedInteger('mini_quiz_id')->nullable();
            $table->foreign('mini_quiz_id')->references('id')->on('Mini_quiz');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('Identify_text_quiz', function (Blueprint $table) {
            $table->increments('id');

            $table->string('correct_quiz');
            $table->string('incorrect_quiz');
            $table->integer('energy_loss');
            $table->integer('points_to_obtain_for_word');
            $table->integer('unlock_rate');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('Book_type', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('author_name');
            $table->integer('year_published');
            $table->string('isbn');
            $table->string('state');

            /**
             * Generation focus level je atribut, ktory popisuje uroven knihy.
             * Sluzi na generaciu na mape, podla oblubenosti/narocnosti knihy.
             * Moze byt od 1 do 5. Pozn. pre mareka: (velkostMapy - 1)/2
             */
            $table->integer('generation_focus_level');
            $table->integer('energy_for_clearing');
            $table->integer('time_for_clearing');


            $table->unsignedInteger('identify_text_quiz_id')->nullable();
            $table->foreign('identify_text_quiz_id')->references('id')->on('Identify_text_quiz');


            $table->unsignedInteger('mini_quiz_id')->nullable();
            $table->foreign('mini_quiz_id')->references('id')->on('Mini_quiz');

            $table->unsignedInteger('identify_character_quiz_id')->nullable();
            $table->foreign('identify_character_quiz_id')->references('id')->on('Identify_character_quiz');

            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('Borrowing');
        Schema::dropIfExists('Book_type');
        Schema::dropIfExists('Identify_text_quiz');
        Schema::dropIfExists('Mini_quiz_question');
        Schema::dropIfExists('Mini_quiz');
        Schema::dropIfExists('Identify_character_quiz_hint');
        Schema::dropIfExists('Identify_character_quiz');
    }
}
