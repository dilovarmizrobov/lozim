<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query_orders = $this->search_by_id(Order::query());
        $statuses = OrderStatus::all();
        $orders = $this->sorting($query_orders, $request, $statuses)->latest()->paginate(8);

        return view('admin.order.index', ['orders'=>$orders, 'statuses'=>$statuses]);
    }

    private function search_by_id($query) {
        if(request()->has('search') && !is_null(request()->search))
            $query = $query->where('id', request()->search);

        return $query;
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

        return $queryOrders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order->data = $order->created_at->format('H:i / d-m-y');
        $statuses = OrderStatus::all();

        return view('admin.order.show', ['order'=>$order, 'statuses'=>$statuses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_id = $request->status_id;
        $order->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
