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
        $orders = Order::whereNotIn('status', [0])->get();
        $orders_decline = Order::where('status', 0)->get();
        return view('backend.order.all_order', compact('orders', 'orders_decline'));
    } //end methods

    public function OrderDetailsStatus($code)
    {
        $order = Order::where('code', $code)->first();
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        return view('backend.order.details_order', compact('order','order_details'));
    } //end methods
   
    public function UpdateOrderStatus(Request $request)
    {
        $id = $request->input('order_id');
        $status = $request->input('status');
        $order = Order::find($id);
        
        if($order){
            $order->status = $status;
            $order->save();
        }

        $orders = Order::whereNotIn('status', [0])->get();
        $orders_decline = Order::where('status', 0)->get();
        return view('backend.order.status_order', compact('orders', 'orders_decline'));
    } //end methods


    // // tracking methods 
    // public function Tracking()
    // {
    //     $orders = Order::whereNotIn('status', [0])->get();
    //     return view('backend.order.tracking_order', compact('orders'));
    // } //end methods

    // public function OrderTracking(Request $request)
    // {
    //     $code = $request->input('code');
    //     $orders = Order::where('code', $code)->get();
    //     return view('backend.order.tracking_order_search', compact('orders'));
    // } //end methods

}
