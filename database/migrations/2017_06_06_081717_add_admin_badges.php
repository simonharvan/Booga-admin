<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Admin_badge_type', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('description');

        });

        Schema::create('Admin_badge', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('admin_badge_type_id');

            $table->foreign('admin_id')->references('id')->on('Admin');
            $table->foreign('admin_badge_type_id')->references('id')->on('Admin_badge_type');
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
        //
    }
}
