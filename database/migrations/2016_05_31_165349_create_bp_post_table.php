<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->integer('featured')->default(0);
            $table->string('featured_img', 100)->default('default.jpg');
            $table->string('post_link');
            $table->string('post_type');
            $table->string('post_template')->default('default');
            $table->integer('post_weight')->default(0);
            $table->integer('post_view')->default(0);
            $table->string('post_active',3)->default('yes');
            $table->integer('lang')->default(1);
            $table->integer('staff_id')->default(1);
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
        Schema::drop('bp_posts');
    }
}
