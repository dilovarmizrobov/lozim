<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::query();
        $orders = $this->search_by_id($orders)->orderBy('id', 'desc')->get();
        $statuses = OrderStatus::all();

        return view('admin.order.index', ['orders'=>$orders, 'statuses'=>$statuses]);
    }

    private function search_by_id($query) {
        if(request()->has('search') && !is_null(request()->search))
            $query = $query->where('id', request()->search);

        return $query;
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
