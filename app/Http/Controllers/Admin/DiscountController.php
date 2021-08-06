<?php

namespace App\Http\Controllers\Admin;

use App\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_discount')->only(['index']);
        $this->middleware('can:create_discount')->only(['create', 'store']);
        $this->middleware('can:edit_discount')->only(['edit', 'update']);
        $this->middleware('can:delete_discount')->only(['destroy']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::query();
        if ($keyword = \request()->search) {
            $discounts = $discounts->where('code', 'LIKE', "%{$keyword}%");
        }

        $discounts = $discounts->latest()->paginate(20);
        $discounts->appends(\request()->query())->links();
        return view('panel.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required'],
            'type' => ['in:int,percen'],
            'value' => ['required', 'numeric'],
            'expired_at' => ['required'],
        ], [], ['value' => 'مقدار', 'expired_at' => 'تاریخ', 'code' => 'کد']);

        $data['expired_at'] = convertPersianToEnglish($data['expired_at']);
        $data['expired_at'] = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y-m-d', $data['expired_at']);
        Discount::create($data);
        toastr()->success('کد تخفیف با موفقیت ایجاد شد');
        return redirect(route('admin.discount.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        return view('panel.discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $data = $request->validate([
            'code' => ['required'],
            'type' => ['in:int,percen'],
            'value' => ['required', 'numeric'],
            'expired_at' => ['required'],
        ], [], ['value' => 'مقدار', 'expired_at' => 'تاریخ', 'code' => 'کد']);

        $data['expired_at'] = convertPersianToEnglish($data['expired_at']);
        $data['expired_at'] = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y-m-d', $data['expired_at']);

        $discount->update($data);
        toastr()->success('کد تخفیف با موفقیت ویرایش شد');
        return redirect(route('admin.discount.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        toastr()->success('کد تخفیف با موفقیت حذف شد');
        return back();
    }
}
