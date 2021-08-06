<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Sluggable;
    protected $fillable = ['title', 'text', 'short_text', 'is_active', 'visit', 'user_id', 'image' , 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsToMany(CategoryArticle::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
}
