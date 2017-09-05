<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Bp_relationship extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'bp_relationships';

    protected $fillable = [
    	 'term_id','post_id','type'
    ];



    public function post()
    {
        return $this->belongsTo('Modules\Core\Entities\Bp_post');
    }


}
