<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->string('value');
            $table->integer('stroke_style_id')->unsigned()->nullable();
            $table->integer('fill_style_id')->unsigned()->nullable();
            $table->integer('shadow_style_id')->unsigned()->nullable();
            $table->integer('align_style_id')->unsigned()->nullable();
            $table->integer('baseline_style_id')->unsigned()->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('texts', function (Blueprint $table) {
			$table->foreign('stroke_style_id')->references('id')->on('stroke_styles');
			$table->foreign('fill_style_id')->references('id')->on('fill_styles');
			$table->foreign('shadow_style_id')->references('id')->on('shadow_styles');
			$table->foreign('align_style_id')->references('id')->on('align_styles');
			$table->foreign('baseline_style_id')->references('id')->on('baseline_styles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('texts');
    }
}
