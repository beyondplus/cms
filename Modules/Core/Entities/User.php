<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'users';

    protected $fillable = [
    	'id','name', 'email','avatar','password','api_token', 'user_type', 'created_at'
    ];

    protected $hidden = ['password'];
    
    public function parent()
    {
        return $this->belongsTo('App\user', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\user', 'parent_id');
    }
}
