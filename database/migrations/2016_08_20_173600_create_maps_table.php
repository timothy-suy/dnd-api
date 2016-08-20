<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('pixel_width')->unsigned()->comment('in pixels');
            $table->integer('pixel_height')->unsigned()->comment('in pixels');
            $table->integer('square_width')->unsigned()->comment('in squares');
            $table->integer('square_height')->unsigned()->comment('in squares');
            $table->integer('square_id')->unsigned();
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('maps', function (Blueprint $table) {
			$table->foreign('square_id')->references('id')->on('squares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maps');
    }
}
