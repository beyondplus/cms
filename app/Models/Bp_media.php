<?php

namespace Beyondplus\models;

use Illuminate\Database\Eloquent\Model;

class Bp_media extends Model
{
    protected $primaryKey = 'media_id';
    protected $table = 'bp_media';

    protected $fillable = [
    	 'media_name','media_link','media_weight','media_description','media_created','created_at','updated_at'
    ];


  
}