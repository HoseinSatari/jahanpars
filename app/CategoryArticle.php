<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryArticle extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = ['name', 'parent', 'is_active', 'image', 'view_order', 'slug'];

    public function child()
    {
        return $this->hasMany(CategoryArticle::class, 'parent', 'id');
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

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
