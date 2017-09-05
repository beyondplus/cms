<?php

namespace Modules\Restapi\Entities;

use Illuminate\Database\Eloquent\Model;

class Bp_messages extends Model
{
    protected $primaryKey = 'message_id';
    protected $table = 'bp_messages';

    protected $fillable = [
    	 'message_id', 'post_id','message_value','message_active', 'message_type','user_id','created_at','updated_at'
    ];

  	public function users()
    {
        return $this->hasMany(User::class,'id', 'customer_id');
    }
}
