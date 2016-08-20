<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transformation_id')->unsigned();
            $table->float('width');
            $table->float('height');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('scales', function (Blueprint $table) {
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
        Schema::drop('scales');
    }
}
