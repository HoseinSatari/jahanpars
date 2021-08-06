<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\attribute;
use App\Indicator;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_product')->only(['index']);
        $this->middleware('can:create_product')->only(['create', 'store']);
        $this->middleware('can:edit_product')->only(['edit', 'update']);
        $this->middleware('can:delete_product')->only(['destroy']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::where('is_active', '1');

        if (\request()->inventory) {
            $products = $products->orderBy('inventory', 'asc');
        }
        if (\request()->product == 1) {
            $products = Product::where('is_active', '0');
        }
        if (\request()->product == 2) {
            $products = product::where('is_active', '1');
        }
        if (\request()->gran == 1) {
            $products = product::orderBy('price', 'desc');
        }
        if (\request()->arzn == 1) {
            $products = product::orderBy('price', 'asc');
        }
        if (\request()->visit == 1) {
            $products = Product::withCount('visit')->orderBy('visit_count', 'desc');
        }
        if (\request()->sell == 1) {
            $products = Product::withCount('order')->orderBy('order_count', 'desc');
        }

        if ($keyword = \request()->search) {
            $products = $products->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('descrip', 'LIKE', "%{$keyword}%")
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })->orWhereHas('categories', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                });
        }


        $products = $products->paginate(20);

        $products->appends(\request()->query())->links();
        return view('panel.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.product.create');
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
            'title' => ['required', 'string'],
            'short_descrip' => ['required'],
            'descrip' => ['required'],
            'price' => ['required', 'numeric'],
            'inventory' => ['required'],
            'category' => ['required'],
            'attributes' => ['array'],
            'image' => ['required'],
        ]);

        $product = auth()->user()->product()->create($data);
        $product->categories()->sync($data['category']);
        if ($request->has('deactive')) $product->update(['is_active' => '0']);

        if (isset($data['attributes'])) {
            $this->AttachAttributProduct($data['attributes'], $product);
        }
        toastr()->success('با موفقیت ایجاد شد.');
        return redirect(route('admin.product.index'));
    }


    public function edit(product $product)
    {
        return view('panel.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {

        $data = $request->validate([
            'title' => ['required', 'string'],
            'short_descrip' => ['required'],
            'descrip' => ['required'],
            'price' => ['required', 'numeric'],
            'inventory' => ['required'],
            'category' => ['required'],
            'attributes' => ['array'],
            'image' => ['required'],
        ]);

        $product->update($data);
        $product->categories()->sync($data['category']);
        $request->has('deactive') ? $product->update(['is_active' => '0']) : $product->update(['is_active' => '1']);
        if (isset($data['attributes'])) {
            $product->attributes()->detach();
            $this->AttachAttributProduct($data['attributes'], $product);
        }

        toastr()->success('با موفقیت ویرایش شد.');
        return redirect(route('admin.product.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
        toastr()->success('با موفقیت حذف شد.');
        return back();
    }

    protected function AttachAttributProduct($attributes1, product $product): void
    {
        $attributes = collect($attributes1);
        $attributes->each(function ($item) use ($product) {
            if (is_null($item['name']) and is_null($item['value'])) return;

            $attr = \App\Attribute::firstorcreate([
                'name' => $item['name'],
            ]);

            $attr_value = $attr->values()->firstOrCreate([
                'value' => $item['value'],
            ]);

            $product->attributes()->attach($attr->id, ['value_id' => $attr_value->id]);

        });
    }

}
