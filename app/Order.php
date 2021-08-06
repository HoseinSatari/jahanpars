<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'price', 'tracking_serial' , 'address' , 'phone' , 'code'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot(['quantity', 'price']);
    }

    public function discount()
    {
        return $this->belongsToMany(Discount::class , 'discounts_user' );
    }

    public function statuss()
    {
        switch ($this->status) {
            case 'paid' :
                return 'پرداخت شده';
            case 'unpaid' :
                return 'پرداخت نشده';
            case 'unpaid' :
                return 'پرداخت نشده';
            case 'prepartion' :
                return 'در حال پردازش';
            case 'posted' :
                return ' ارسال شده';
            case 'recived' :
                return 'دریافت شده ';
            case 'cancel' :
                return 'لغو شده';
        }
    }
}
