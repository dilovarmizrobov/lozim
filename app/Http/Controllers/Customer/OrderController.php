<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    private $sorting_items = [
        ['newly', 'up', 'price'],
        ['completed', 'down', 'price'],
        ['newly', 'down', 'id'],
    ];

    public function index(Request $request)
    {
        $sorting_items = OrderStatus::all();
        $query_orders = Order::where('user_id', Auth::id())->latest();
        $orders = $this->sorting($query_orders, $request, $sorting_items);

        return view('customer.order.index', compact('orders', 'sorting_items'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        if (Gate::denies('customer_can', $order->user->id))
            return redirect(route('store.product.index'))
                ->with('success', 'У вас нет прав для выполнения данного действия!');

        return view('customer.order.show', compact('order'));
    }

    private function sorting($queryOrders, $request, $sortingItems)
    {
        $sorting_items = OrderStatus::all();

        if (array_key_exists('sort', $request->all())) {
            foreach ($sorting_items as $item) {
                if ($request->sort === $item->slug) {
                    $queryOrders->where('status_id', $item->id);
                }
            }
        }

        return $queryOrders->get();
    }
}
