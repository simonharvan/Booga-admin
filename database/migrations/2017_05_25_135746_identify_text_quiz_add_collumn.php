<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IdentifyTextQuizAddCollumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Identify_text_quiz', function (Blueprint $table){
            $table->string('correct_words');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Identify_text_quiz', function (Blueprint $table){
            $table->dropColumn('correct_words');
        });
    }
}
