<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    // Product Methods
    public function AllProduct()
    {
        $categories = Category::latest()->get();
        $products = Product::latest()->get();  // get data team

        return view('backend.product.all_product', compact('products', 'categories'));
    } //end methods
    public function AddProduct()
    {
        $categories = Category::latest()->orderBy('id', 'asc')->get();

        return view('backend.product.add_product', compact('categories'));
    } //end methods

    // Add Data Product 
    public function StoreProduct(Request $request)
    {
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_name_slug = strtolower(str_replace(' ', '-', $request->product_name)); /// replace ' ' => '-',
        $product->code = rand(000000000, 999999999);
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->hot_deal = ($request->input('hot_deal')) ? 1 : 0;
        $product->hot_new = ($request->input('hot_new')) ? 1 : 0;
        $product->short_desc = $request->short_desc;
        $product->description = $request->description;
        $product->status = 1;
        $product->created_at = Carbon::now();

        //upload file photo
        if ($request->file('image')) {
            $image_name = '';
            $file = $request->file('image');
            $image_name = hexdec(uniqid()) . '_product_image.' . $file->getClientOriginalExtension(); //2003.avatar-2
            Image::make($file)->resize(500, 500)->save('upload/product/'.$image_name);
            // $file->move(public_path('upload/product'), $image_name);
            $product->image = 'upload/product/' . $image_name;
        }

        $product->save();
        $notification = array(
            'message' => ' Product Data Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    } //end methods

    // Edit Product controller
    public function EditProduct($id)
    {
        $categories = Category::latest()->orderBy('id', 'asc')->get();
        $product = Product::findOrFail($id);
        return view('backend.product.edit_product', compact('product', 'categories'));
    } //end methods
    // Update Product
    public function UpdateProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_name_slug = strtolower(str_replace(' ', '-', $request->product_name)); /// replace ' ' => '-',       
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->hot_deal = ($request->input('hot_deal')) ? 1 : 0;
        $product->hot_new = ($request->input('hot_new')) ? 1 : 0;
        $product->short_desc = $request->short_desc;
        $product->description = $request->description;
        $product->updated_at = Carbon::now();

        //upload file photo
        if ($request->file('image')) {
            @unlink(public_path($product->image));
            $image_name = '';
            $file = $request->file('image');
            $image_name = hexdec(uniqid()). '_product_image.' . $file->getClientOriginalExtension(); //2003.avatar-2
            Image::make($file)->resize(500, 500)->save('upload/product/'.$image_name);
            //$file->move(public_path('upload/product'), $image_name);
            // dd($image_name);
            $product->image = 'upload/product/' . $image_name;
        }

        $product->save();
        $notification = array(
            'message' => ' Product Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    } //end methods

    // Delete Product
    public function DeleteProduct($id)
    {

        $product = Product::findOrFail($id);
        if ($product->image) {
            @unlink(public_path($product->image));
        }
        $product->delete();
        $notification = array(
            'message' => 'Delete Product Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end methods

    ///// Update Comment Status
    public function UpdateProductStatus(Request $request)
    {
        $productId = $request->input('product_id');
        $isChecked = $request->input('is_checked');
        
        $product = Product::find($productId);

        if ($product) {
            $product->status = $isChecked;
            $product->save();
        }

        return response()->json(['message' => 'Product Status Updated Successfully']);
    } //end methods
}
