<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class DeliveryController extends Controller
{
    public function index()
    {
        $orders = Order::where('status_id', 3)->get();

        return view('admin.delivery.index', compact('orders'));
    }

    public function products()
    {
        $products = Product::query()
            ->join('order_product', 'order_product.product_id', '=', 'products.id')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->where('orders.status_id', '=', 3)
            ->groupBy('product_id')
            ->selectRaw('products.*, SUM(order_product.quantity) AS order_quantity')
            ->get();

        return view('admin.delivery.products', compact('products'));
    }
}
