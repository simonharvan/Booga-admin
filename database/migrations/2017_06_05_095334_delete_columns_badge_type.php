<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnsBadgeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Badge_type', function (Blueprint $table){
            $table->dropForeign(['event_type_id']);
            $table->dropColumn('event_type_id');
            $table->dropColumn('operator');
            $table->dropColumn('number');
            $table->dropColumn('picture_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Badge_type', function (Blueprint $table){
            $table->unsignedInteger('event_type_id')->nullable();
            $table->foreign('event_type_id')->references('id')->on('Event_type');
            $table->string('operator');
            $table->integer('number');
            $table->string('picture_url');
        });
    }
}
