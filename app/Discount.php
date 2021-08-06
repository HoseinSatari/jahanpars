<?php

namespace App;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['code', 'type', 'value', 'expired_at'];

    public function value($total)
    {
        if ($this->type == 'int') {
            return $total - $this->value;
        } else {
            return $total - ($total / 100) * $this->value;
        }

    }

    public function check()
    {
        return $this->belongsToMany(User::class , 'discounts_user');
    }
}
