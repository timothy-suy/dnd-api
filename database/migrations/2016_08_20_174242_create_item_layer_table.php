<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_layer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('layer_id')->unsigned();
            $table->integer('transformation_id')->unsigned()->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::table('item_layer', function (Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('items');
			$table->foreign('layer_id')->references('id')->on('layers');
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
        Schema::drop('item_layer');
    }
}
