<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->integer('map_id')->unsigned();
			$table->integer('square_id')->unsigned();
			$table->integer('left')->unsigned();
			$table->integer('top')->unsigned();
			$table->integer('width')->unsigned();
			$table->integer('height')->unsigned();
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('views', function (Blueprint $table) {
			$table->foreign('map_id')->references('id')->on('maps');
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
        Schema::drop('views');
    }
}
