<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transformation_id')->unsigned();
            $table->float('x');
            $table->float('y');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('translations', function (Blueprint $table) {
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
        Schema::drop('translations');
    }
}
