<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Bp_media extends Model
{
    protected $primaryKey = 'media_id';
    protected $table = 'bp_medias';

    protected $fillable = [
    	 'media_name','media_link', 'media_type','media_weight','media_description','staff_id','created_at','updated_at'
    ];



}
