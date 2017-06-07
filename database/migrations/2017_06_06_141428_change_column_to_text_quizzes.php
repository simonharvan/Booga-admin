<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnToTextQuizzes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Identify_text_quiz', function (Blueprint $table){
            $table->dropColumn('correct_quiz');
            $table->dropColumn('incorrect_quiz');
            $table->dropColumn('correct_words');

        });

        Schema::table('Identify_text_quiz', function (Blueprint $table){
            $table->text('correct_quiz');
            $table->text('incorrect_quiz');
            $table->text('correct_words');
        });

        Schema::table('Mini_quiz', function (Blueprint $table){
            $table->dropColumn('question');
            $table->dropColumn('answers');
            $table->text('question');
            $table->text('answers');
        });

        Schema::table('Condition', function (Blueprint $table){
            $table->dropColumn('script');
        });
        Schema::table('Condition', function (Blueprint $table){
            $table->text('script');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
