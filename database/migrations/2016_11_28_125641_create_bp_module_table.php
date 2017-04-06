<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_modules', function (Blueprint $table) {
            $table->increments('module_id');
            $table->string('module_name');
            $table->string('module_link');
            $table->integer('module_weight')->default(1);
            $table->string('module_icon');
            $table->integer('parent_id')->default(1);
            $table->integer('staff_id')->default(0);
            $table->integer('section')->default(0);
            $table->string('group_access',100);
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
        Schema::drop('bp_modules');
    }
}
