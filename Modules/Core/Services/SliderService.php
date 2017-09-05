<?php

namespace Modules\Core\Services;

use Validator;
use Illuminate\Validation\ValidationException;
use Modules\Core\Entities\Bp_slider;
use Modules\Core\Utils\Limit;

class SliderService
{
 	public function search($where , $paginate = Limit::NORMAL){
	    $array = Bp_slider::get();
	    $array = $array->toArray();
	    $query = Bp_slider::latest();
	    foreach ($where as $key => $value) {
	      $key = ltrim($key, Limit::QUERY);
	      if(array_key_exists($key, $array[0])){
	        if($key == 1){
	            $query = $query->Where($key, 'like', '%'.urldecode($value).'%');
	        } else {
	            $query = $query->orWhere($key, 'like', '%'.urldecode($value).'%');
	        }
	      }
	    }
	    $query = $query->paginate($paginate);
	    return $query;
	 }
   
}
