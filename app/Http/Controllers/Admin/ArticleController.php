<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_article')->only(['index']);
        $this->middleware('can:create_article')->only(['create', 'store']);
        $this->middleware('can:edit_article')->only(['edit', 'update']);
        $this->middleware('can:delete_article')->only(['destroy']);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('is_active', '1');

        if (\request()->article == 1) {
            $articles = Article::where('is_active', '0');
        }
        if (\request()->article == 2) {
            $articles = Article::where('is_active', '1');
        }
        if (\request()->visit == 1) {
            $articles = Article::withCount('visit')->orderBy('visit_count', 'desc');
        }
        if ($keyword = \request()->search) {
            $articles = $articles->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('short_text', 'LIKE', "%{$keyword}%")
                ->orWhere('text', 'LIKE', "%{$keyword}%")
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })->orWhereHas('category', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                });
        }


        $articles = $articles->paginate(20);
        $articles->appends(\request()->query())->links();
        return view('panel.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.article.create');
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
            'title' => ['required', 'string'],
            'short_text' => ['required'],
            'text' => ['required'],
            'category' => ['required'],
            'image' => ['required'],
        ]);

        $article = auth()->user()->article()->create($data);
        $article->category()->attach($data['category']);
        if ($request->has('deactive')) $article->update(['is_active' => '0']);

        toastr()->success('با موفقیت ایجاد شد.');
        return redirect(route('admin.article.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('panel.article.edit' , compact('article'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'short_text' => ['required'],
            'text' => ['required'],
            'category' => ['required'],
            'image' => ['required'],
        ]);

        $article->update($data);
        $article->category()->sync($data['category']);
        $request->has('deactive') ? $article->update(['is_active' => '0']) : $article->update(['is_active' => '1']);

        toastr()->success('با موفقیت ویرایش شد.');
        return redirect(route('admin.article.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        toastr()->success('با موفقیت حذف شد.');
       return back();
    }
}
