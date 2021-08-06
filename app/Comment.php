<?php

namespace App;

use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'email', 'user_id', 'comment', 'approved', 'parent_id', 'product_id', 'commentable_id', 'commentable_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rel()
    {
        $this->morphTo();
    }

    public function child()
    {
        return $this->hasMany(Comment::class , 'parent_id');
    }

}
