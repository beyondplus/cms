<?php

namespace Modules\Restapi\Entities;

use Illuminate\Database\Eloquent\Model;

class Bp_term extends Model
{
    protected $primaryKey = 'tax_id';
    protected $table = 'bp_taxes';

    protected $fillable = [
    	'tax_id','parent_id', 'tax_name', 'tax_link','tax_icon', 'tax_desc', 'tax_lan','tax_type','tax_active', 'staff_id'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

}
