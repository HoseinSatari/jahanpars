<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_value extends Model
{
    protected $fillable = ['value', 'attribute_id'];

    public function attributes()
    {
        return $this->belongsTo(Attribute::class , 'attribute_id' ,'id');
    }
}
