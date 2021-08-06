<?php

namespace App\Http\Middleware;

use App\Product;
use Closure;
use Illuminate\Support\Facades\Auth;

class cart
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()){
            $user = \auth()->user();
            collect($user->cart)->each(function ($item){
                $product = Product::where('id' , $item['product_id'])->first();
                if ($product->inventory == '0'){
                    $item->delete();
                }
                if ($product->inventory < $item['qty']){
                    $item->update(['qty' => $product->inventory]);
                }
            });
        }
        return $next($request);
    }
}
