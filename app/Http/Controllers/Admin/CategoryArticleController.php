<?php

namespace App\Http\Controllers\Admin;

use App\CategoryArticle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_categroy_article')->only(['index']);
        $this->middleware('can:create_categroy_article')->only(['create', 'store']);
        $this->middleware('can:edit_categroy_article')->only(['edit', 'update']);
        $this->middleware('can:delete_categroy_article')->only(['destroy']);


    }
    public function index()
    {
        $categories = CategoryArticle::where('parent', 0)->orderBy('view_order', 'ASC');

        if ($keyword = \request()->search) {
            $categories = $categories->where('name', 'LIKE', "%{$keyword}%");
        }
        if (\request()->delete) {
            $categories = CategoryArticle::onlyTrashed();
        }

        $categories = $categories->latest()->paginate(20);
        $categories->appends(\request()->query())->links();
        return view('panel.categoryarticle.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.categoryarticle.create');
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
                'parent' => 'exists:category_articles,id',
            ]);
        }
        $data = $request->validate([
            'name' => 'required',
            'view_order' => 'required' ,
            'image' => 'nullable'
        ]);

        CategoryArticle::create([
            'name' => $data['name'],
            'parent' => $request->parent ?? 0,
            'view_order' => $data['view_order'],
            'image' =>  $data['image'] ,
        ]);

        toastr()->success('با موفقیت ثبت شد.');
        return redirect(route('admin.categoryA.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryArticle $categoryA)
    {

        return view('panel.categoryarticle.edit' , ['category' => $categoryA]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryArticle $categoryA)
    {
        $data = $request->validate([
            'name' => 'required',
            'parent' => 'required',
            'view_order' => 'required' ,
            'image' => 'nullable'
        ]);

        $categoryA->update($data);

        toastr()->success('با موفقیت ویرایش شد.');
        return redirect(route('admin.categoryA.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryArticle $categoryA)
    {
        $categoryA->delete();
        toastr()->success('با موفقیت حذف شد.');
        return back();
    }

    public function restor(Request $request)
    {
        CategoryArticle::withTrashed()
            ->where('id', $request->id)
            ->restore();

        toastr()->success('با موفقیت برگشت داده شد.');
        return back();
    }
}
