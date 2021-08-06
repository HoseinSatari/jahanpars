<?php

namespace App;


use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{


    protected $fillable = ['name', 'label'];

    public function rolls()
    {
        return $this->belongsToMany(role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
