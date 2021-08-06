<?php

namespace App\Http\Controllers\User;

use App\Favourite;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function store(Product $id)
    {
        $status = Favourite::where('user_id', auth()->user()->id)->where('product_id', $id->id)->first();

        $status ? $status->delete() : auth()->user()->favourite()->create(['product_id' => $id->id]);

        return response(['success' => true]);
    }
}
