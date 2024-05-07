<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller
{
    // Contact Methods
    public function AllContact(){
        $contacts = Contact::latest()->get();  // get data team

        return view('backend.contact.all_contact', compact('contacts'));
    }//end methods


    // Edit Contact controller
    public function ShowContact($id){
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }//end methods

    
    // Delete Contact
    public function DeleteContact($id){
                    
        Contact::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Delete Contact Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end methods
}