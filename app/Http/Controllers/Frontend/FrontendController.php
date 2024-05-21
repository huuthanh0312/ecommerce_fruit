<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function About(){
        $about = Post::where('title_slug', 'câu-chuyện-thương-hiệu')->first();
        $posts = Post::latest()->orderBy('id', 'desc')->get();
        return view('frontend.about.about', compact('about', 'posts'));
    }

    public function Policy($slug){
        $about = Post::where('title_slug', $slug)->first();
        $posts = Post::latest()->orderBy('id', 'desc')->get();
        return view('frontend.about.about', compact('posts', 'about'));
    }
    public function Contact(){
        $site = SiteSetting::find(1);
        return view('frontend.about.contact', compact('site'));
    }

    public function ContactStore(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required',
            'message'=> 'required',          
        ]); 
        Contact::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'message'=> $request->message,  
        ]);

        $notification = array(
            'message'=> 'You Sent A Message Successfully',
            'alert-type' => 'success'
        );
        // Notification::send($user, new BookingComplete($request->name));
        return redirect()->back()->with($notification);
    }
}
