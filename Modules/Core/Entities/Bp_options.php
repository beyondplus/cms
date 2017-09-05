<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Bp_options extends Model
{
    protected $primaryKey = 'option_id';
    protected $table = 'bp_options';

    protected $fillable = [
    	'option_id','option_name', 'option_value'
    ];

}
