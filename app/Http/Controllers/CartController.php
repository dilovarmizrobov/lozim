<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Validator;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        $total = (double)str_replace(' ', '', Cart::subtotal());
        $delivery_price = config('cart.delivery_price');
        $delivery_from = config('cart.delivery_from');
        $hasFreeShipping = $total > $delivery_from;
        return view('guest.cart', compact('delivery_price', 'delivery_from', 'hasFreeShipping'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id'=>'required|integer|min:1',
            'product_count'=>'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $duplicates = Cart::search(function ($cartItem) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            Cart::update($duplicates->first()->rowId, $request->product_count);
        } else {
            Cart::add($product->id, $product->name, $request->product_count, $product->price)
                ->associate(Product::class);
        }

        $total = (double)str_replace(' ', '', Cart::subtotal());
        $delivery_from = config('cart.delivery_from');
        $hasFreeShipping = $total > $delivery_from;

        return [
            'total_price' => number_format($total, 2, '.', ' '),
            'count_products' => Cart::content()->count(),
            'hasFreeShipping' => $hasFreeShipping
        ];
    }

    public function remove($id)
    {
        Cart::remove($id);

        return redirect()->back()->with('success', 'Товар был успешно удален из корзины!');
    }
}
