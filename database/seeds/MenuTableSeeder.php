<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Bp_menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bp_menu::truncate();
     	Bp_menu::create([
     		'menu_name' => '',
     		'parent_id'		=>	'0',
     		'created_at'    => '2016-06-3 00:36:29'
     		]);
    }
}
