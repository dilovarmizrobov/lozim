<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Mail\OrderShipped;
use Cart;
use Mail;

class CheckoutController extends Controller
{
    public function index() {
        if (Cart::content()->count() == 0) {
            return redirect()->route('guest.index');
        }

        $total = (double)str_replace(' ', '', Cart::subtotal());
        $delivery_price = config('cart.delivery_price');
        $delivery_express_price = config('cart.delivery_express_price');
        $delivery_from = config('cart.delivery_from');
        $hasFreeShipping = $total > $delivery_from;
        $total = number_format($total + ($hasFreeShipping ? 0 : $delivery_price), 2);

        return view('customer.checkout', compact('total', 'delivery_price', 'delivery_express_price', 'delivery_from', 'hasFreeShipping'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required|max:255',
            'address'=>'required|max:255',
            'comment'=>'max:600',
            'contactAgree'=>'required|accepted',
            'delivery' => 'required|in:regular,express'
        ]);

        $user = auth()->user();
        $total = (double)str_replace(' ', '', Cart::subtotal());

        $order = $user->orders()->create([
            'delivery' => $request->delivery,
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

        foreach (User::query()->where('role', 'admin')->get() as $user)
            Mail::to($user)->send(new OrderShipped($order));

        return redirect()->route('customer.order.show', $order->id);
    }
}
