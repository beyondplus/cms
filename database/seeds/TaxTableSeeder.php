<?php

use Illuminate\Database\Seeder;
use ILLuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Bp_tax;

class TaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	Bp_tax::truncate();
     	Bp_tax::create([
     		'tax_name'      => 'Uncategorized',
     		'parent_id'		=>	'0',
            'tax_desc'      =>	'Uncategorized',
            'tax_link'      => 'uncategorized',
     		'tax_active'    =>	'yes',
            'tax_type'      => 'category',
     		'created_at'    => '2016-06-3 00:36:29'
     		]);
    }
}
