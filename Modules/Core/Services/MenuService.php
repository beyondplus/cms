<?php

namespace Modules\Core\Services;

use Validator;
use Illuminate\Validation\ValidationException;
use Modules\Core\Entities\Bp_post;
use Modules\Core\Entities\Bp_menu;
use Modules\Core\Utils\Limit;

class MenuService
{
  public function menu($per_page){
  	$query['menu'] = Bp_menu::where('parent_id','>',0)->orderBy('menu_id', 'desc')->get();
    $query['pages']=  Bp_post::select('id','title')->where('post_type','page')->orderBy('id', 'desc')->get();
    $query['posts']=  Bp_post::select('id','title')->where('post_type','post')->orderBy('id', 'desc')->get();
    return $query;
  }
   
}
