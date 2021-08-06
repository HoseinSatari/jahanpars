<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\GalleryProduct;
use App\Product;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_gallery')->only(['index']);
        $this->middleware('can:create_gallery')->only(['create', 'store']);
        $this->middleware('can:edit_gallery')->only(['edit', 'update']);
        $this->middleware('can:delete_gallery')->only(['destroy']);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $images = $product->Gallery()->latest()->paginate(30);
        return view('panel.product.gallery.all' , compact('product' ,'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('panel.product.gallery.create' , compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Product $product)
    {
        $data = $request->validate([
            'images.*.image' => ['required'],
            'images.*.alt'   => ['required' , 'min:3'],
        ]);

        collect($data['images'])->each(function ($image) use ($product){
            $product->gallery()->create($image);
        });
        toastr()->success('با موفقیت ثبت شد.');
        return redirect(route('admin.gallery.index' , ['product' => $product->id]));
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
    public function edit(Product $product , GalleryProduct $gallery)
    {
        return view('panel.product.gallery.edit' , compact('product' , 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product , GalleryProduct $gallery)
    {
        $data = $request->validate([
            'image' => ['required'],
            'alt'   => ['required' , 'min:3'],
        ]);
        $gallery->update($data);
        toastr()->success('با موفقیت ویرایش شد.');
        return redirect(route('admin.gallery.index' , ['product' => $product->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product , GalleryProduct $gallery)
    {
        $gallery->delete();
        toastr()->success('با موفقیت حذف شد.');
        return redirect(route('admin.gallery.index' , ['product' => $product->id]));
    }
}
