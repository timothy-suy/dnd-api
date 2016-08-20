<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 64)->nullable();
			$table->string('source');
			$table->integer('x')->unsigned();
			$table->integer('y')->unsigned();
			$table->integer('width')->unsigned()->nullable();
			$table->integer('height')->unsigned()->nullable();
			$table->integer('source_x')->unsigned()->nullable();
			$table->integer('source_y')->unsigned()->nullable();
			$table->integer('source_width')->unsigned()->nullable();
			$table->integer('source_height')->unsigned()->nullable();
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
        Schema::drop('images');
    }
}
