<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('width')->unsigned()->comment('in pixels');
            $table->integer('height')->unsigned()->comment('in pixels');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('graphics', function (Blueprint $table) {
            $table->integer('items_id')->unsigned();
            $table->integer('order')->unsigned();
        });
        Schema::table('graphics', function (Blueprint $table) {
			$table->foreign('items_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
