<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Mail\OrderShipped;
use Cart;
use Mail;
use Carbon\Carbon;
use Str;

class CheckoutController extends Controller
{
    const DELIVERY_MAX_DATE = 3;
    const DELIVERY_TIMES = [
        '8' => '08:00-09:00',
        '9' => '09:00-10:00',
        '10' => '10:00-11:00',
    ];

    public function index() {
        if (Cart::content()->count() == 0) {
            return redirect()->route('guest.index');
        }

        $total = (double)str_replace(' ', '', Cart::subtotal());
        $delivery_express_price = config('cart.delivery_express_price');
        $delivery_price = config('cart.delivery_price');
        $delivery_from = config('cart.delivery_from');
        $hasFreeShipping = $total > $delivery_from;
        $total = number_format($total + ($hasFreeShipping ? 0 : $delivery_price), 2);
        $delivery_price = $hasFreeShipping ? 0 : $delivery_price;

        $delivery_times = self::DELIVERY_TIMES;
        $delivery_dates = [];
        $today = Carbon::now();
        $begin_date_delivery = $today->hour < 16 ? $today : $today->addDay(1);

        for ($i = 1; $i <= self::DELIVERY_MAX_DATE; $i++) {
            $delivery_date = $begin_date_delivery->addDay(1);
            $delivery_dates[$delivery_date->format('Y-m-d')] = Str::title($delivery_date->translatedFormat('l, j F'));
        }

        return view('customer.checkout', compact('total', 'delivery_price', 'delivery_express_price',
            'delivery_from', 'hasFreeShipping', 'delivery_times', 'delivery_dates'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required|max:255',
            'address'=>'required|max:255',
            'comment'=>'max:600',
            'contactAgree'=>'required|accepted',
            'checkoutDelivery' => 'required|in:regular,express',
            'delivery_time' => 'required|numeric|max:50000',
            'delivery_date' => 'required|date',
        ]);

        $user = auth()->user();
        $total = (double)str_replace(' ', '', Cart::subtotal());
        $delivery_from = config('cart.delivery_from');
        $delivery_price = 0;

        if ($request->checkoutDelivery === 'express') {
            $delivery_price = config('cart.delivery_express_price');
        } elseif ($request->checkoutDelivery === 'regular' && $total < $delivery_from) {
            $delivery_price = config('cart.delivery_price');
        }

        $delivery_date = Carbon::now();

        if ($request->checkoutDelivery === 'regular') {
            $delivery_times = self::DELIVERY_TIMES;
            $delivery_time = array_key_exists($request->delivery_time, $delivery_times)
                ? $request->delivery_time : array_shift($delivery_times);
            $delivery_date = Carbon::parse($request->delivery_date)->setHour($delivery_time);
        }

        $order = $user->orders()->create([
            'delivery' => $request->checkoutDelivery,
            'delivery_price' => $delivery_price,
            'delivery_date' => $delivery_date,
            'total' => $total,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'comment' => $request->comment
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
