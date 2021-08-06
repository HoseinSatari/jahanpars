<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['user_id','title' , 'subtitle' ,'body' ,'button' , 'link' ,'image' , 'order' , 'is_active'];


}
