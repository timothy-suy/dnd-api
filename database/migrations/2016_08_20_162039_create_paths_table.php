<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->nullable();
            $table->integer('width')->unsigned()->comment('the relative width of the path in pixels');
            $table->integer('height')->unsigned()->comment('the relative height of the path in pixels');
            $table->integer('line_style_id')->unsigned()->nullable();
            $table->integer('stroke_style_id')->unsigned()->nullable();
            $table->integer('fill_style_id')->unsigned()->nullable();
            $table->integer('shadow_style_id')->unsigned()->nullable();
            $table->string('parts')->comment('the instructions needed to draw the path on a canvas');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('paths', function (Blueprint $table) {
			$table->foreign('line_style_id')->references('id')->on('line_styles');
			$table->foreign('stroke_style_id')->references('id')->on('stroke_styles');
			$table->foreign('fill_style_id')->references('id')->on('fill_styles');
			$table->foreign('shadow_style_id')->references('id')->on('shadow_styles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paths');
    }
}
