<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{
    protected $fillable = ['visitable_type' , 'visitable_id' , 'ip' , 'qty'];



}
