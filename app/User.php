<?php

namespace App;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'is_superuser', 'is_staff', 'email_verified_at', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function issuperuser()
    {
        return $this->is_superuser;
    }

    public function isstaff()
    {
        return $this->is_staff;
    }

    public function setPasswordAttribute($value)
    {

        $this->attributes['password'] = Hash::make($value);
    }

    public function rolls()
    {
        return $this->belongsToMany(role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(permission::class);
    }

    public function hasroll($rolls)
    {
        return $rolls->intersect($this->rolls)->all();

    }

    public function haspermission($permission)
    {
        return $this->permissions->contains('name', $permission->name) || $this->hasroll($permission->rolls);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function article()
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    public function slider()
    {
        return $this->hasMany(Slider::class);
    }

    public function activeCode()
    {
        return $this->hasOne(code::class, 'user_id', 'id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailNotification());
    }

    public function favourite()
    {
        return $this->hasMany(Favourite::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function discount()
    {
        return $this->belongsToMany(Discount::class, 'discounts_user')->withPivot(['discount_id']);
    }

    public function company()
    {
        return $this->hasMany(Company::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function checkCart($product)
    {
        $cart = $this->cart->where('product_id', $product->id)->first();
        if (isset($cart)) {

            if ($product->inventory > $cart->qty) {
                return false;
            } else {
                return true;
            }

        } else {
            return false;
        }
    }

    public function total()
    {
        return $this->cart->sum(function ($item){
            return Product::where('id' , $item['product_id'])->first()->price * $item['qty'];
        });
    }
}

