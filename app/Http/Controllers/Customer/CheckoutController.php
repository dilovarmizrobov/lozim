<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index() {
        if (Cart::content()->count() == 0) {
            return redirect()->route('guest.index');
        }

        return view('customer.checkout');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required|max:255',
            'address'=>'required|max:255',
            'comment'=>'max:600',
            'contactAgree'=>'required|accepted'
        ]);

        $user = auth()->user();
        $total =(double)str_replace(' ', '', Cart::subtotal());

        $order = $user->orders()->create([
            'total'=> $total,
            'name'=> $request->name,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'comment'=> $request->comment
        ]);

        foreach (Cart::content() as $item) {
            $order->products()->save($item->model, ['quantity'=> $item->qty, 'price'=> $item->price]);
        }

        Cart::destroy();

        return redirect()->route('customer.order.show', $order->id);
    }
}
