<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_styles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->nullable();
            $table->integer('line_width')->unsigned()->nullable();
            $table->integer('line_join_id')->unsigned()->nullable();
            $table->integer('line_cap_id')->unsigned()->nullable();
            $table->integer('miter_limit')->unsigned()->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('line_styles', function (Blueprint $table) {
			$table->foreign('line_join_id')->references('id')->on('line_joins');
			$table->foreign('line_cap_id')->references('id')->on('line_caps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('line_styles');
    }
}
