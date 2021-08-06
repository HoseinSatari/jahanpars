<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_slider')->only(['index']);
        $this->middleware('can:create_slider')->only(['create', 'store']);
        $this->middleware('can:update_slider')->only(['edit', 'update']);
        $this->middleware('can:delete_slider')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::query();

        if ($keyword = \request()->search) {
            $sliders = $sliders->where('subtitle', 'LIKE', "%{$keyword}%")
                ->orWhere('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%")
                ->orWhere('button', 'LIKE', "%{$keyword}%");
        }

        $sliders = $sliders->orderBy('order', 'asc')->paginate(10);
        $sliders->appends(\request()->query())->links();
        return view('panel.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.slider.create');
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
            'subtitle' => 'nullable',
            'title' => 'nullable',
            'body' => 'nullable',
            'image' => 'required',
            'link' => 'nullable',
            'button' => 'nullable',
            'order' => 'nullable'
        ]);
        if ($data['order'] == null) {
            $data['order'] = '0';
        }
        $slid = auth()->user()->slider()->create($data);
        $request->is_active ? $slid->update(['is_active' => '0']) : '';

        toastr()->success('اسلاید به موفقیت ایجاد شد');
        return redirect(route('admin.slider.index'));
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
    public function edit(Slider $slider)
    {
        return view('panel.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'subtitle' => 'nullable',
            'title' => 'nullable',
            'body' => 'nullable',
            'image' => 'required',
            'link' => 'nullable',
            'button' => 'nullable',
            'order' => 'nullable'
        ]);
        if ($data['order'] == null) {
            $data['order'] = '0';
        }
        $slider->update($data);
        $request->is_active ? $slider->update(['is_active' => '0']) : $slider->update(['is_active' => '1']);
        toastr()->success('اسلاید به موفقیت ایجاد شد');
        return redirect(route('admin.slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        toastr()->success('اسلاید با موفقیت حذف شد');
        return back();
    }
}
