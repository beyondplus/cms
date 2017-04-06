<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$languages = array( 
    					array('language_iso' => 'en','language_value' => 'English'),
    					array('language_iso' => 'mm','language_value' => 'Myanmar'),
    					);

    	foreach ($languages as $key => $value) {
    		DB::table('bp_languages')->insert([
	        	'language_iso' => 	$languages[$key]['language_iso'],
	        	'language_value' => $languages[$key]['language_value'],
	        	'created_at' => Carbon::now(),
        	]);
    	}
        
    }
}
