<?php

namespace Modules\Core\Services;

use Validator;
use Illuminate\Validation\ValidationException;
use Modules\Core\Entities\Bp_custom;
use Modules\Core\Utils\Limit;

class CustomService
{
  public function customs($per_page){
    $query['data'] = Bp_custom::latest()->paginate($per_page)->all();
    return $query;
  }
   
}
