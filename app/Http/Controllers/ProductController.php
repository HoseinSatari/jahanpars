<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function single(Request $request)
    {

        $product = Product::where('slug', $request->slug)->firstorfail();
       if ($visit = $product->visit()->where('ip', $request->ip())->first()) {
          $visit->update(['qty' => $visit->qty + 1]);
       }else{
           $product->visit()->create([
               'visitable_type' => get_class($product),
               'visitable_id'   => $product->id,
               'ip'    => $request->ip(),
               'qty' => '1',
           ]);
       }

        $this->seo()->setTitle("$product->title")->setDescription($product->short_descrip);
        return view('home.single', compact('product'));
    }
}
