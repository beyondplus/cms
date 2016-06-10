<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_menu', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->string('menu_name');
            $table->integer('post_id');
            $table->string('menu_weight');
            $table->string('menu_icon');
            $table->integer('parent_id');
            $table->integer('menu_created');
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
        Schema::drop('bp_menu');
    }
}