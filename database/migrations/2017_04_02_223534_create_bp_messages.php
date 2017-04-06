<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_messages', function (Blueprint $table) {
            $table->increments('message_id');
            $table->integer('post_id');
            $table->text('message_value');
            $table->string('message_active', 3);
            $table->string('message_type', 7);
            $table->integer('user_id')->default(0);
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
        Schema::drop('bp_messages');
    }
}
