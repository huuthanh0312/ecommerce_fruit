<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function AllOrder()
    {
        $orders = Order::latest()->get();

        return view('backend.order.all_order', compact('orders'));
    } //end methods

    public function OrderDetailsStatus($code)
    {
        $order = Order::where('code', $code)->first();
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        return view('backend.order.details_order', compact('order','order_details'));
    } //end methods
   
}
