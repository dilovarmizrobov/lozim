<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $products = Auth::user()->favorites()->limit(2)->get();
        $orders = Auth::user()->orders()->limit(2)->get();

        return view('customer.index', compact('products', 'orders'));
    }
}
