<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Borrowing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Borrowing', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('age');
            $table->string('borrowed_from');
            $table->string('borrowed_to');

            $table->unsignedInteger('book_type_id')->nullable();
            $table->foreign('book_type_id')->references('id')->on('Book_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Borrowing');
    }
}
