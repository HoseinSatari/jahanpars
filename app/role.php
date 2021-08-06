<?php

namespace App;

use App\permission;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{

    protected $fillable = ['name', 'label'];

    public function permissions()
    {
        return $this->belongsToMany(permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
