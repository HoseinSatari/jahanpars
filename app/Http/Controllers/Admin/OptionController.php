<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Options;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_option')->only(['index']);


    }
    public function index()
    {
        $option = Options::find(1);

        return view('panel.option.index', compact('option'));
    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'sitename' => ['required'],
            'image'  => ['required'],
            'description' => ['required'],
            'keyword' => ['required'],
            'phone' => ['required'],
            'phoneadmin' => ['required'],
            'location' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'instagram' => ['required'],
            'whatsup' => ['required'],
            'telegram' => ['required'],
        ]);

       $option = Options::find(1);
       $option->update($data);
        if ($request->deactive){
            $option->update(['is_active' => '0']);
        }else{
            $option->update(['is_active' => '1']);
        }
        toastr()->success('تنظیمات با موفقیت اعمال شدند');
        return back();
    }
}
