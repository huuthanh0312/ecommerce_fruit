<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    // Post Methods
    public function AllPost(){
        $posts = Post::latest()->get();  // get data team

        return view('backend.post.all_post', compact('posts'));
    }//end methods
    public function AddPost(){
        return view('backend.post.add_post');
    }//end methods

      // Add Data Post 
    public function StorePost(Request $request){ 
    
        Post:: insert([
            'title'=> $request->title,
            'title_slug'=> strtolower(str_replace(' ', '-', $request->title)), /// replace ' ' => '-',
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'=> ' Post Data Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('post.all')->with($notification);
    }//end methods

    // Edit Post controller
    public function EditPost($id){
        $post = Post::findOrFail($id);
        return view('backend.post.edit_post', compact('post'));
    }//end methods
        // Update Post
    public function UpdatePost(Request $request){
        $data = Post::find($request->id);
        $data->title = $request->title;
        $data->title_slug = strtolower(str_replace(' ', '-', $request->title));  /// replace ' ' => '-',  
        $data->description = $request->description;
        $data->save();

        $notification = array(
            'message'=> ' Post Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('post.all')->with($notification);
    }//end methods

    // Delete Post
    public function DeletePost($id){
                    
        Post::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Delete Post Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end methods
}