<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_category')->only(['index']);
        $this->middleware('can:create_category')->only(['create' , 'store']);
        $this->middleware('can:edit_category')->only(['edit' , 'update']);
        $this->middleware('can:delete_category')->only(['destroy']);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent', 0)->orderBy('view_order', 'ASC');

        if ($keyword = \request()->search) {
            $categories = $categories->where('name', 'LIKE', "%{$keyword}%");
        }
        if (\request()->delete) {
            $categories = category::onlyTrashed();
        }

        $categories = $categories->latest()->paginate(20);
        $categories->appends(\request()->query())->links();
        return view('panel.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\request()->parent) {
            $request->validate([
                'parent' => 'exists:categories,id',
            ]);
        }
        $data = $request->validate([
            'name' => 'required',
            'view_order' => 'required' ,
            'image' => 'nullable'
        ]);

        Category::create([
            'name' => $data['name'],
            'parent' => $request->parent ?? 0,
            'view_order' => $data['view_order'],
            'image' =>  $data['image'] ,
        ]);

        toastr()->success('با موفقیت ثبت شد.');
        return redirect(route('admin.category.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('panel.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $data = $request->validate([
            'name' => 'required',
            'parent' => 'required',
            'view_order' => 'required' ,
            'image' => 'nullable'
        ]);

        $category->update($data);

        toastr()->success('با موفقیت ویرایش شد.');
        return redirect(route('admin.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        toastr()->success('با موفقیت حذف شد.');
        return back();
    }

    public function restor(Request $request)
    {
        category::withTrashed()
            ->where('id', $request->id)
            ->restore();

        toastr()->success('با موفقیت برگشت داده شد.');
        return back();
    }
}
