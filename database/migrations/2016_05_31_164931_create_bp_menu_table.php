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
        Schema::create('bp_menus', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->string('menu_name');
			$table->string('menu_link')->default('');
            $table->integer('post_id')->default(0);
            $table->integer('menu_weight')->default(0);
            $table->string('menu_icon')->default('');
            $table->integer('parent_id')->default(1);
            $table->string('menu_type')->default('default');
            $table->integer('staff_id')->default(1);
            $table->string('lang',3)->default('en');
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
        Schema::drop('bp_menus');
    }
}
