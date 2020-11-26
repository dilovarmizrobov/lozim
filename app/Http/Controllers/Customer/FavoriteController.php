<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Auth;
use App\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $products = Auth::user()->favorites()->latest()->get();
        return view('customer.favorite', compact('products'));
    }

    public function toggle($id)
    {
        Product::findOrFail($id);
        $favorites = Auth::user()->favorites();

        if ($favorites->where('product_id', $id)->exists())
            $favorites->detach($id);
        else $favorites->attach($id);
    }
}
