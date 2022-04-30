<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $query_orders = $this->search_by_id(Order::query());
        $statuses = OrderStatus::all();
        $orders = $this->sorting($query_orders, $request)->latest()->paginate(10);

        return view('admin.order.index', ['orders'=>$orders, 'statuses'=>$statuses]);
    }

    private function search_by_id($query) {
        if(request()->has('search') && !is_null(request()->search))
            $query = $query->where('id', request()->search);

        return $query;
    }

    private function sorting($queryOrders, $request)
    {
        $sorting_items = OrderStatus::all();

        if (array_key_exists('sort', $request->all())) {
            foreach ($sorting_items as $item) {
                if ($request->sort === $item->slug) {
                    $queryOrders->where('status_id', $item->id);
                }
            }
        }

        return $queryOrders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store()
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $order = Order::findOrFail($id);
        $statuses = OrderStatus::all();

        return view('admin.order.show', ['order'=>$order, 'statuses'=>$statuses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return void
     */
    public function edit()
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->status_id = $request->status_id;
        $order->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function destroy()
    {
        abort(404);
    }
}
