<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class PageController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->limit(9)->get();

        return view('guest.index', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);
        dump($product);
    }
}
