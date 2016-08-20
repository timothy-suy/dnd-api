<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transformation_id')->unsigned();
            $table->float('angle')->comment('angle in radians');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('rotations', function (Blueprint $table) {
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
        Schema::drop('rotations');
    }
}
