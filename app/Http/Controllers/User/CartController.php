<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function addtocart(Request $request)
    {

        $user = auth()->user();
        $product = Product::where('id', $request->id)->first();
        $request->qty ? $data = $request->validate(['qty' => ['numeric']]) : $data['qty'] = '1';

        $cart = $user->cart()->where('product_id', $product->id)->first();
        if (isset($cart)) {

            if ($product->inventory >= $cart->qty + $data['qty']) {
                $cart->update(['qty' => $cart->qty + $data['qty']]);
                toastr()->success('موجودی محصول انتخاب شده افزایش یافت');
                return back();

            } else {
                toastr()->error('موجودی محصول انتخاب شده کمتر از تعداد سفارش شماست');
                return back();
            }

        } else {
            if ($product->inventory >= $data['qty']) {
                $user->cart()->create(['product_id' => $product->id, 'qty' => $data['qty']]);
                toastr()->success('محصول مورد نظر به سبد خرید افزوده شد');
                return back();
            } else {
                toastr()->error('موجودی محصول انتخاب شده کمتر از تعداد سفارش شماست');
                return back();
            }

        }

    }

    public function cartchange(Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required',
            'id' => 'required',
        ]);

        $cart = \App\Cart::where('id', $data['id'])->first();
        $cart->update(['qty' => $data['quantity']]);
        $user = \App\User::find($cart->user_id);
        $sum = $user->cart->sum(function ($item) {
            return Product::where('id', $item['product_id'])->first()->price * $item['qty'];
        });

        return response(['status' => 'success', 'price' => $sum]);


    }

    public function remove(Request $request)
    {
        if ($request->id) {

            $cart = \App\Cart::where('id', $request->id)->first();

            $cart->delete();
            toastr()->success('محصول از سبد خرید حذف شد');
            return back();
        }
        return back();
    }

    public function cart()
    {
        if (auth()->user()->cart->count()){
            $this->seo()->setTitle('سبد خرید')->setDescription('صفحه سبد خرید');
            return view('user.cart');
        }
        toastr()->warning('سبد خرید شما خالی است');
        return redirect(route('home'));


    }
}
