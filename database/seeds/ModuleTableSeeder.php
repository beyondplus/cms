<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Bp_module;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bp_module::truncate();
        $module = array(array("Post","post",0,"fa fa-home",0,0,'{"user":"0",staff":"1","admin":"1"}'), array("Page","page",0,"fa fa-edit",0,0,'{"user":"0",staff":"1","admin":"1"}'),array("Menu","menubar",0,"fa fa-table",0,0,'{"user":"0",staff":"1","admin":"1"}'),array("Media","media",0,"fa fa-desktop",0,0,'{"user":"0",staff":"1","admin":"1"}'),array("Slider","slider",0,"fa fa-clone",0,0,'{"user":"0",staff":"1","admin":"1"}'),array("User Management","user",0,"fa fa-windows",0,1,'{"user":"0",staff":"1","admin":"1"}'),array("Settings","settings",0,"fa fa-bug",0,1,'{"user":"0",staff":"1","admin":"1"}'),array("Custom","custom",0,"fa fa-windows",0,1,'{"user":"0",staff":"1","admin":"1"}'),array("Add Custom","addcustom",0,"fa fa-sitemap",0,1,'{"user":"1",staff":"1","admin":"1"}'));
        $this->createModule($module);

        $child = array(array("Post","post",0,"fa fa-home",1,0,'{"user":"0",staff":"1","admin":"1"}'), array("Category","category",0,"fa fa-edit",1,0,'{"user":"0",staff":"1","admin":"1"}'),array("Taxonomy","taxonomy",0,"fa fa-table",1,0,'{"user":"0",staff":"1","admin":"1"}'),array("Account","account",0,"fa fa-desktop",6,0,'{"user":"0",staff":"1","admin":"1"}'),array("Permisson","user",0,"fa fa-windows",7,1,'{"user":"0",staff":"1","admin":"1"}'),array("Generals","settings",0,"fa fa-bug",7,1,'{"user":"0",staff":"1","admin":"1"}'));
        $this->createModule($child);
        
    }

    public function createModule($module){
        for ($i=0; $i < count($module); $i++) {
            $Bp_module = [
                'module_name'       => $module[$i][0],
                'module_link'       => $module[$i][1],
                'module_weight'     => $module[$i][2],
                'module_icon'       => $module[$i][3],
                'parent_id'         => $module[$i][4],
                'staff_id'          => '1',
                'section'           => $module[$i][5],
                'group_access'      => $module[$i][6],
                'created_at'        => '2016-06-3 00:36:29'
            ];
            Bp_module::insert($Bp_module);
        }
    }
}
