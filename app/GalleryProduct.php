<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class GalleryProduct extends Model
{

    protected $fillable = ['image', 'alt'];

    public function product()
    {
        return $this->belongsTo(products::class );
    }
}
