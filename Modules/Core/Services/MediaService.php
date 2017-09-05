<?php

namespace Modules\Core\Services;

use Validator;
use Illuminate\Validation\ValidationException;
use Modules\Core\Entities\Bp_media;
use Modules\Core\Utils\Limit;

class MediaService
{
 	public function search($where , $paginate = Limit::NORMAL){
	    $array = Bp_media::all();
	    $array = $array->toArray();
	    $query = Bp_media::latest();
	    foreach ($where as $key => $value) {
	      $key = ltrim($key, Limit::QUERY);
	      if(array_key_exists($key, $array[0])){
	        if($key == 1){
	            $query = $query->Where($key, 'like', '%'.urldecode($value).'%');
	        } else {
	            $query = $query->orWhere($key, 'like', '%'.urldecode($value).'%');
	        }
	      } else {

	      }
	    }
	    $query = $query->paginate($paginate);
	    return $query;
	 }
   
}
