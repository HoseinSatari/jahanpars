<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes , Sluggable;

    protected $fillable = ['name', 'parent', 'is_active', 'image', 'view_order', 'slug'];

    public function child()
    {
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
