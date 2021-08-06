<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::query();

        if (!$request->q) {
            if (!$request->c){
            $this->seo()->setTitle("فروشگاه");
            $products = $products->where('is_active' , '1')->orderBy('inventory' , 'desc')->paginate(30);
            }

        }

        if ($request->c) {
            $category = Category::whereslug($request->c)->firstorfail();
            $products = $products->where('is_active' , '1')->WhereHas('categories', function ($query) use ($category) {
                $query->where('id', "$category->id");
            })->where('is_active' , '1')->orderBy('inventory' , 'desc')->paginate(30);
            $this->seo()->setTitle("$category->name");
        }

        if ($keyword = $request->q) {
            $products = $products->orwhere('title', 'LIKE', "%{$keyword}%")
                ->orwhere('descrip', 'LIKE', "%{$keyword}%")
                ->orwhere('short_descrip', 'LIKE', "%{$keyword}%")
                ->orWhereHas('categories', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })->where('is_active' , '1')->orderBy('inventory' , 'desc')->paginate(30);
            $this->seo()->setTitle("$request->q");
        }




        $products->appends(\request()->query())->links();
        return view('home.shop', compact('products'));
    }
}
