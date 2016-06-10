<?php

namespace Beyondplus\models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $primaryKey = 'images_id';
    protected $table = 'advertise_images';

    protected $fillable = [
    	'images_id','images_name', 'images_url','images_desc',
    ];
}
