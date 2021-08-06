<?php


namespace App\Helper\cart;

use App\Helper\cart;
use Illuminate\Support\ServiceProvider;

class CartServicProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cart' , function (){
            return new CartServic();
        });

    }
}
