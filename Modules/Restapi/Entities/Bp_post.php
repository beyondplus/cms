<?php

namespace Modules\Restapi\Entities;

use Illuminate\Database\Eloquent\Model;

class Bp_post extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'bp_posts';

    protected $fillable = [

    	 'title', 'body','featured','featured_img','post_link','post_type', 'post_template','post_weight','post_active','staff_id','lang','created_at'

    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function category()
    {
        return $this->belongsTo('Modules\Restapi\Entities\Category');
    }

    public function categories()
    {
        return $this->belongsToMany('Modules\Restapi\Entities\Bp_term', 'bp_relationships' ,'post_id', 'term_id');
    }


}
