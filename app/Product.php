<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Sluggable, SoftDeletes;


    protected $fillable = ['user_id', 'title', 'descrip', 'price', 'inventory', 'view_count', 'is_active', 'slug', 'image', 'short_descrip'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'products_id')->withPivot(['value_id']);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function is_active()
    {
        return $this->is_active;
    }

    public function Gallery()
    {
        return $this->hasMany(GalleryProduct::class, 'product_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function visit()
    {
        return $this->morphMany(visit::class, 'visitable');
    }

    public function visitor()
    {
        return collect($this->visit()->get())->sum(function ($vist) {
            return $vist['qty'];
        });
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')->withPivot(['quantity']);
    }

    public function favourite()
    {
        return $this->hasMany(Favourite::class);
    }

}
