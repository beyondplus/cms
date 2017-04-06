<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_sliders', function (Blueprint $table) {
            $table->increments('slider_id');
            $table->string('slider_name');
            $table->string('slider_link');
            $table->string('slider_type');
            $table->integer('slider_weight');
            $table->text('slider_description');
            $table->integer('staff_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bp_sliders');
    }
}
