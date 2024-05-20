<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart as ModelsCart;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Auth;
class FrProductController extends Controller
{
    //
    public function ProductByCategory($slug){
        $category_by_product = Category::where('category_name_slug', $slug)->first();
        $products = Product::where('category_id', $category_by_product->id)->orderBy('id', 'asc')->get();
        $product_hot_news = Product::where('hot_new', 1)->limit(4)->get();
        $product_hot_deals = Product::where('hot_deal', 1)->limit(4)->get();
        $categories  = Category::all();
        return view('frontend.product.product_by_category', compact('products','category_by_product', 'categories','product_hot_news','product_hot_deals'));
    }
    public function AllProduct(){
        $products = Product::all();
        $product_hot_news = Product::where('hot_new', 1)->limit(4)->get();
        $product_hot_deals = Product::where('hot_deal', 1)->limit(4)->get();
        $categories  = Category::all();
        return view('frontend.product.all_product', compact('products', 'categories','product_hot_news','product_hot_deals'));
    }

    public function ProductDetails($slug){
        $product = Product::where('product_name_slug', $slug)->first();
        $categories = Category::all();
        $product_hot_deals = Product::where('hot_deal', 1)->get();
        return view('frontend.product.product_details', compact('product', 'categories', 'product_hot_deals'));
    }

    public function AddCartForJS(Request $request){
        $id = $request->input('id');
        $product = Product::find($id);
        
        if(Auth::check()){
            $cart_check = ModelsCart::where('product_id', $id)->first();
            
            if(empty($cart_check)){
                $cart_user = new ModelsCart();
                $cart_user->user_id = Auth::user()->id;
                $cart_user->product_id = $id;
                $cart_user->name = $product->product_name;
                $cart_user->qty = 1;
                $cart_user->price = $product->price;
                $cart_user->image = $product->image;
                
            } elseif($cart_check->product_id == $id) {
                $cart_check->qty += 1;
                $cart_check->update();
            }
            

        }
        Cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'qty' => 1, 
            'price' => $product->price, 
            'options' => [
                'image' => $product->image,
            ]
            ]);
        $carts = Cart::content();
        $totalPrice = Cart::subtotal();
        
        $countCart = 0;
        foreach($carts as $cart){
            $countCart += $cart->qty;
        }
        
        return view('frontend.order.cart_ajax', compact('countCart', 'carts', 'totalPrice'));
    }

    public function StoreCart(Request $request){
        $id = $request->id;
        $qty = $request->qty;
        $product = Product::find($id);
        if(Auth::check()){
            $cart_check = ModelsCart::where('product_id', $id)->first();
            if($cart_check->product_id == $id){
                $cart_check->qty += $cart_check->qty + $qty;
            } else {
                $cart_user = new ModelsCart();
                $cart_user->user_id = Auth::user()->id;
                $cart_user->product_id = $id;
                $cart_user->name = $product->product_name;
                $cart_user->qty = $qty;
                $cart_user->price = $product->price;
                $cart_user->image = $product->image;
            }
            

        }
        Cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'qty' => $qty, 
            'price' => $product->price, 
            'options' => [
                'image' => $product->image,
            ]
            ]);
            $notification = array(
                'message'=> ' Add Product Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('cart.list')->with($notification);
    }

    public function DeleteCartForJs(Request $request){
        $id = $request->id;
        $rowId = $request->rowId;
        Cart::remove($rowId); 
        if(Auth::check()){
            ModelsCart::where('user_id', Auth::user()->id)->where('product_id', $id)->delete();
        }
        
        $countCart = 0;
        $carts = Cart::content();
        foreach($carts as $cart){
            $countCart += $cart->qty;
        }
        $totalPrice = Cart::subtotal();
        return view('frontend.order.cart_ajax', compact('countCart', 'carts','totalPrice'));
    }


    public function ListCart(){
        $carts = Cart::content();
        return view('frontend.order.list_cart', compact('carts'));
    }
}