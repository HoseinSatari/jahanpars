<?php

namespace App\Http\Controllers\Admin;

use App\Events\ApprovedOrder;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_order')->only(['index']);
        $this->middleware('can:product_order')->only(['show']);
        $this->middleware('can:cancel_order')->only(['cancel']);
        $this->middleware('can:delete_order')->only(['destroy']);


    }

    public function index()
    {
        $orders = Order::query();

        if ($serach = \request('search')) {
            $orders = $orders
                ->where('code', $serach)
                ->orWhere('tracking_serial', $serach)
                ->orWhereHas('user', function ($query) use ($serach) {
                    $query->where('name', 'LIKE', "%{$serach}%");
                });
                ;
        }
        $orders = $orders->where('status', \request('type'))->latest()->paginate(20);
        return view('panel.order.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('panel.order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['unpaid', 'paid', 'prepartion', 'posted', 'recived', 'cancel'])],
            'tracking_serial' => ['nullable'],
        ]);

        if ($data['status'] == 'paid'){
             event(new ApprovedOrder($order->user->phone , $order->user->name , $order->code , number_format($order->price)));
        }
        $order->update($data);
        toastr()->success('سفارش با موفقیت ویرایش شد');
        return redirect(route('admin.orders.index') . "?type=$order->status");
    }

    public function show(Order $order)
    {
        $products = $order->products()->latest()->paginate(20);
        return view('panel.order.show', compact('products', 'order'));
    }

    public function cancel(Order $id)
    {
        $id->products->sum(function ($item) {
            $item->update(['inventory' => $item->inventory + $item->pivot->quantity]);
            return $item->inventory;
        });
        $id->update(['status' => 'cancel']);
        toastr()->success('سفارش کنسل شد ، تعداد کالای سفارش شده بازگشت داده شد');
        return redirect(route('admin.orders.index') . "?type=$id->status");
    }

    public function destroy(Order $order)
    {
        $order->delete();
        toastr()->success('سفارش با موفقیت حذف شد');
        return back();
    }


}
