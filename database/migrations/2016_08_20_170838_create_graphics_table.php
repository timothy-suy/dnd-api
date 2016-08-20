<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graphics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transformation_id')->unsigned()->nullable();
            $table->integer('graphic_id')->unsigned();
            $table->string('graphic_type');

            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('graphics', function (Blueprint $table) {
			$table->foreign('transformation_id')->references('id')->on('transformations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('graphics');
    }
}
