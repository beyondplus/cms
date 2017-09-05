<?php

namespace Modules\Core\Services;

use Validator;
use Illuminate\Validation\ValidationException;
use Modules\Core\Entities\Bp_options;
use Modules\Core\Utils\Limit;

class SettingsService
{
  public function settings($per_page){
    $query = Bp_options::orderBy('option_id')->simplePaginate($per_page);
    return $query;
  }
   
}
