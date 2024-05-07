<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Customer Methods
    public function AllCustomer(){
        $customers = User::where('role', 'user')->get();  // get data team

        return view('backend.customer.all_customer', compact('customers'));
    }//end methods

    // Edit Customer controller
    public function EditCustomer($id){
        $customer = User::findOrFail($id);
        return response()->json($customer);
    }//end methods
    
    // Update Customer
    public function UpdateCustomer(Request $request){
        $data = User::find($request->id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;   
        $data->save();

        $notification = array(
            'message'=> ' Customer Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('category.all')->with($notification);
    }//end methods

    ///// Update Comment Status
    public function UpdateCustomerStatus(Request $request ){
        $customerId = $request->input('customer_id');
        $isChecked = $request->input('is_checked',0);
        $status = 'active';
        if($isChecked == 0){
            $status = 'inactive';
        }
        $customer = User::find($customerId);

        if($customer ){
            $customer->status = $status;
            $customer->save();
        }

        return response()->json(['message' => 'Customer Status Updated Successfully']);
    }

}