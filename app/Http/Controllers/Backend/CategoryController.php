<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    // Category Methods
    // Category controller 
    public function AllCategory(){
        $categories = Category::latest()->get();  // get data team

        return view('backend.category.all_category', compact('categories'));
    }//end methods

      // Add Data Category 
    public function StoreCategory(Request $request){ 
    
        Category:: insert([
            'category_name'=> $request->category_name,
            'category_name_slug'=> strtolower(str_replace(' ', '-', $request->category_name)), /// replace ' ' => '-',
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'=> ' Category Data Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end methods

    // Edit Category controller
    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return response()->json($category);
    }//end methods
        // Update Category
    public function UpdateCategory(Request $request){
        $data = Category::find($request->id);
        $data->category_name = $request->category_name;
        $data->category_name_slug = strtolower(str_replace(' ', '-', $request->category_name));  /// replace ' ' => '-',  
        $data->save();

        $notification = array(
            'message'=> ' Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('category.all')->with($notification);
    }//end methods

    // Delete Category
    public function DeleteCategory($id){
                    
        Category::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Delete Category Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end methods

}