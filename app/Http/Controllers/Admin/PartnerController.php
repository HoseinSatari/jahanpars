<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_partner')->only(['index']);
        $this->middleware('can:create_partner')->only(['create', 'store']);
        $this->middleware('can:edit_partner')->only(['edit', 'update']);
        $this->middleware('can:delete_partner')->only(['destroy']);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::query();

        if ($keyword = \request()->search){
            $partners = $partners->where('name' , 'LIKE' , "%{$keyword}%")
                ->orWhere('phone' , 'LIKE', "%{$keyword}%");
        }

        $partners = $partners->latest()->paginate(10);
        $partners->appends(\request()->query())->links();
        return view('panel.partner.index' , compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'phone' => ['nullable'],
            'jobe' => ['required'],
            'image'  =>['required'],
         ]);

        Partner::create($data);
        toastr()->success('کارمند با موفقیت افزوده شد.');
        return redirect(route('admin.partners.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        return view('panel.partner.edit' , compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => ['required'],
            'phone' => ['nullable'],
            'jobe' => ['required'],
            'image'  =>['required'],
        ]);
        $partner->update($data);
        toastr()->success('اطلاعات کارمند با موفقیت ویرایش شد');
        return redirect(route('admin.partners.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        toastr()->success('کارمند با موفقیت حذف شد');
        return redirect(route('admin.partners.index'));
    }
}
