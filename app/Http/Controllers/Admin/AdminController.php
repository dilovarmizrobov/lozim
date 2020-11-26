<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Product;
use App\Property;
use App\Category;
use App\Feedback;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {
        $orders = Order::count();
        $products = Product::count();
        $feedbacks = Feedback::count();
        $categories = Category::count();
        $attributes = Property::count();

        return view('admin.index', compact('orders', 'products', 'categories', 'feedbacks', 'attributes'));
    }
}
