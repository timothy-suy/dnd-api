<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShadowStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shadow_styles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color')->nullable();
            $table->integer('blur')->nullable();
            $table->integer('offset_x')->nullable();
            $table->integer('offset_y')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shadow_styles');
    }
}
