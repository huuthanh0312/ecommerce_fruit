<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart as ModelsCart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Stripe;
class FrOrderController extends Controller
{
    //
    public function Checkout(){
        $carts = Cart::content();
        if(Auth::check()){
            $id = Auth::user()->id;
            $customer = User::where('id', $id)->first();
        }

        return view('frontend.order.checkout', compact('carts', 'customer'));
    }
    // Check Out Store
    public function CheckoutStore(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required',
            'country'=> 'required',
            'phone'=> 'required',
            'address'=> 'required',
            'state'=> 'required',
            'zip_code'=> 'required',
            'payment_method'=> 'required',          
        ]);      
        $total_price = (Cart::Subtotal());
        //dd($total_price);
        $code = rand(000000000, 999999999);
        $data = new Order();
       
        $data->user_id = Auth::user()->id;
        $data->total_price = $total_price;
        $data->payment_method = $request->payment_method;
        $amount = $total_price / 25000;

        if($request->payment_method == 'Stripe'){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
           
            $s_pay = Stripe\Charge::create([
                "amount" => $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment For Booking. Booking No ".$code,
            ]);
            if($s_pay['status'] == 'succeeded'){
                $data->transaction_id = $s_pay->id;
                $data->payment_status = 1;
            }
        }elseif($request->payment_method == 'Paypal'){
            $data->transaction_id = $request->transaction_id;
            $data->payment_status = 1;
        }else{
            $data->transaction_id = '';
            $data->payment_status = 0;
        }
       
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->address = $request->address;
        $data->state = $request->state;
        $data->zip_code = $request->zip_code;

        $data->code = $code;
        $data->status = 1;
        $data->created_at = Carbon::now();
        $data->save(); 

        $carts = Cart::content();
        
        foreach($carts as $cart){
            $order_detail = new OrderDetail();
            $order_detail->order_id = $data->id;
            $order_detail->product_id = $cart->id;
            $order_detail->product_name = $cart->name;
            $order_detail->quantity = $cart->qty;
            $order_detail->price = $cart->price;
            $order_detail->total_price = $cart->subtotal;
            $order_detail->save();
        } 

        Cart::destroy();
        ModelsCart::where('user_id', Auth::user()->id)->delete();
        $notification = array(
            'message'=> 'Place Order Successfully',
            'alert-type' => 'success'
        );
        // Notification::send($user, new BookingComplete($request->name));
        return redirect('/')->with($notification);

    }// end methods
    
    public function ListOrder(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->get();
        return view('frontend.order.list_order' , compact('orders'));
    }
    public function OrderDetails($code){
        $order = Order::where('code', $code)->first();
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        return view('frontend.order.details_order', compact('order_details', 'order'));
    }
  
}