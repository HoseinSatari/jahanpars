<?php

namespace App\Http\Controllers\User;

use App\Discount;
use App\Events\CreateOrder;
use App\Http\Controllers\Controller;
use App\Listeners\CreateOrderAdminSmsListener;
use App\Order;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->cart->count()) {
            if (auth()->user()->phone == null) {
                $request->session()->flash('phone', ['route' => route('cart')]);
                toastr()->warning('لطفا شماره موبایل خود را وارد کنید');
                return redirect(route('user.phone'));
            }
            if (auth()->user()->address == null){
                toastr()->warning('لطفا فیلد ادرس خود را کامل نمایید');
                return redirect(route('profile'))->with(['user_edit' => 1]);
            }
            $total = auth()->user()->cart->sum(function ($item){
                $product = Product::where('id' , $item['product_id'])->first();
                $product->update(['inventory' => $product->inventory - $item['qty']]);
                return $product->price * $item['qty'];
            });

            $orderitem = collect(auth()->user()->cart)->mapWithKeys(function ($item) {
                return [$item['product_id'] => ['quantity' => $item->qty, 'price' => Product::where('id' , $item['product_id'])->first()->price]];
            });

            $code = false;
            if (isset($request->discount) and $request->discount != null) {
                $code = Discount::wherecode($request->discount)->first();
                $status = auth()->user()->discount()->where('discount_id', $code->id)->get()->first();
                if (isset($status)) {
                    $code = false;
                }elseif ($code->expired_at < now()){
                    $code = false;
                }
            }

            auth()->user()->cart()->delete();
            $order = auth()->user()->orders()->create([
                'status' => 'unpaid',
                'price' => $code ? $code->value($total) : $total,
                'address' => auth()->user()->address,
                'phone' => auth()->user()->phone,
                'code' => code(),
            ]);
            if ($code){
                auth()->user()->discount()->attach($code->id , ['order_id' => $order->id]);
            }
            $order->products()->attach($orderitem);
            event(new CreateOrder(option()->phoneadmin , auth()->user()->phone , number_format($order->price) , jdate($order->created_at)->format('%d %B %Y') , $order->code  ));
            toastr('سفارش شما با موفقیت ثبت شد منتظر تماس همکاران ما باشید');
            return redirect(route('profile'))->with(['order' => 1]);

        } else {
            toastr()->error('سبد خرید شما خالی میباشد');
            return redirect(route('home'));
        }
    }

    public function check_discount(Request $request)
    {

        $discount = Discount::wherecode($request->discount)->first();
        if (!$discount) {
            return response(['error' => 'کد تخفیف معتبر نیست']);
        }
        if ($discount->expired_at < now()) {
            return response(['error' => 'زمان استفاده از این کد به پایان رسیده است']);
        }
        if (auth()->check()) {
            if (auth()->user()->discount()->where('discount_id', $discount->id)->get()->first()) {
                return response(['error' => 'شما قبلا از این کد استفاده کردید']);
            }
        }

        if ($discount->type == 'Percen') {
            return response(['success' => 'کد معتبر است و میتوانید استفاده کنید', 'total' =>  number_format(auth()->user()->total() - (auth()->user()->total() / 100) * $discount->value)  ]);
        } elseif ($discount->type == 'int') {
            return response(['success' => '  کد معتبر است و میتوانید استفاده کنید', 'total' =>  number_format(auth()->user()->total() - $discount->value)]);
        }


    }
}
