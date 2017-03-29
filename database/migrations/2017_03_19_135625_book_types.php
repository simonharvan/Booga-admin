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
        Schema::create('book_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('author_name');
            $table->integer('year_published');
            $table->string('isbn');

            $table->unsignedInteger('place_id')->nullable();
            $table->foreign('place_id')->references('id')->on('places');

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
        Schema::dropIfExists('book_types')
    }
}
