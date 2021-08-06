<?php

namespace App\Http\Controllers;

use App\Article;
use App\CategoryArticle;
use App\Options;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function articles(Request $request)
    {
        $articles = Article::query();
        if ($request->c) {
            $category = CategoryArticle::whereslug($request->c)->firstorfail();
            $articles = $articles->WhereHas('category', function ($query) use ($category) {
                $query->where('id', "$category->id");
            })->paginate(15);
            $this->seo()->setTitle("$category->name");
        }

        if ($keyword = $request->q) {
            $articles = $articles->orwhere('title', 'LIKE', "%{$keyword}%")
                ->orwhere('text', 'LIKE', "%{$keyword}%")
                ->orwhere('short_text', 'LIKE', "%{$keyword}%")
                ->orWhereHas('category', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })->paginate(15);
            $this->seo()->setTitle("$request->q");
        }
        if (!$request->q and !$request->c) {
            $this->seo()->setTitle("بلاگ")->setDescription('صفحه مقالات و اخبار جهانپارس');
            $articles = $articles->paginate(15);
        }


        $articles->appends(\request()->query())->links();
        return view('home.article.blog', compact('articles'));
    }

    public function single(Request $request)
    {
        $article = Article::where('slug', $request->slug)->firstorfail();
        if ($visit = $article->visit()->where('ip', $request->ip())->first()) {
            $visit->update(['qty' => $visit->qty + 1]);
        }else{
            $article->visit()->create([
                'visitable_type' => get_class($article),
                'visitable_id'   => $article->id,
                'ip'    => $request->ip(),
                'qty' => '1',
            ]);
        }
        $this->seo()->setTitle($article->title)->setDescription($article->short_text);
        $option = Options::find(1);
        return view('home.article.single', compact('article' ,'option'));
    }
}
