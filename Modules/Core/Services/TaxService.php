<?php

namespace Modules\Core\Services;

use Validator;
use Illuminate\Validation\ValidationException;
use Modules\Core\Entities\Bp_tax;
use Modules\Core\Utils\Limit;

class TaxService
{
  public function taxonomy($per_page){
    $query['data'] = Bp_tax::orderBy('tax_name')->where('tax_type','tax')->simplePaginate($per_page);
    $query['all']= Bp_tax::select('tax_name','tax_id')->where('tax_type','tax')->get();
    return $query;
  }

  public function search($where , $paginate = Limit::NORMAL){
    $array = Bp_tax::where('tax_type','tax')->get()->toArray();
    $query = Bp_tax::orderBy('tax_name', 'desc')->where('tax_type','tax');
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
