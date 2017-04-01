<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Admin_log', function(Blueprint $table){
            $table->increments('id');

            $table->string('text');
            $table->string('type');

            $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('Admin');

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
        Schema::dropIfExists('Admin_log');
    }
}
