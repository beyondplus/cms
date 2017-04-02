<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_media', function (Blueprint $table) {
            $table->increments('media_id');
            $table->string('media_name');
            $table->string('media_link');
            $table->string('media_type');
            $table->integer('media_weight')->default(0);
            $table->text('media_description')->nullable();
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
        Schema::drop('bp_media');
    }
}
