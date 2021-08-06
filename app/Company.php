<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['user_id', 'title', 'short_text', 'text', 'image', 'keyword', 'is_active'];


    public function user()
    {
        return $this->belongsTo(User::class);
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
