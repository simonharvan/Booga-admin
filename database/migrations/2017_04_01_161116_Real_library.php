<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RealLibrary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Library_mapper', function (Blueprint $table) {
            $table->increments('id');

            $table->string('format');
        });

        Schema::create('Real_library', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('url');
            $table->string('database_name');
            $table->integer('port');
            $table->string('street');
            $table->string('city');
            $table->string('street_number');

            $table->unsignedInteger('mapper_id')->nullable();
            $table->foreign('mapper_id')->references('id')->on('Library_mapper');

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
        Schema::dropIfExists('Real_library');
        Schema::dropIfExists('Library_mapper');
    }
}
