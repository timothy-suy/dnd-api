<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrokeStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stroke_styles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color')->nullable();
            $table->string('gradient')->nullable();
            $table->string('pattern')->nullable();
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
        Schema::drop('stroke_styles');
    }
}
