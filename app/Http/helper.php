<?php


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

if (!function_exists('is_active')) {

    function is_active($key, $activeclassname = 'active')
    {
        if (is_array($key)) {
            return in_array(Route::CurrentRouteName(), $key) ? $activeclassname : '';
        }
        return Route::CurrentRouteName() == $key ? $activeclassname : '';

    }
}

if (!function_exists('isUrl')) {

    function isUrl($url, $activeClassName = 'active')
    {
        return \request()->fullUrlIs($url) ? $activeClassName : '';
    }

}
if (!function_exists('url')) {

    function url($url, $activeClassName = 'current')
    {
        return \request()->url() == $url ? $activeClassName : '';
    }

}

if (!function_exists('qty')) {
    function qty($product)
    {

        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = auth()->user();
            $qty = $user->cart->sum(function ($item) {
                $product = \App\Product::where('id', $item['product_id'])->first();
                if ($product->inventory > $item['qty']) {

                    return $product->inventory - $item['qty'];
                }
            });
            return $qty == '0' ? $product->inventory : $qty;
        }
    }
}
if (!function_exists('option')) {
    function option()
    {
        return \App\Options::find(1);
    }
}
if (!function_exists('code')) {
    function code()
    {
        $code = mt_rand(100000, 999999);
       $status = \App\Order::where('code' , $code)->first();
        if ($status){
            $code = mt_rand(100000, 999999);
        }
        return $code;
    }
}
function convertPersianToEnglish($string) {
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    $output= str_replace($persian, $english, $string);
    return $output;
}
