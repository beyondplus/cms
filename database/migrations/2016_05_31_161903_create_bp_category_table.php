<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name');
            $table->string('category_name_mm')->default('');
            $table->integer('parent_id')->default(0);
            $table->string('category_link');
            $table->string('category_icon')->nullable();
            $table->text('category_desc');
            $table->integer('count_view')->default(0);
            $table->integer('category_dash')->default(0);
            $table->string('category_active',3)->default('yes');
            $table->string('lang',3)->default('en');
            $table->integer('staff_id')->default(0);
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
        Schema::drop('bp_categories');
    }
}
