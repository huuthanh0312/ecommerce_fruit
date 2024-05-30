<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    //
    public function AdminDashboard(){
        return view('admin.index');
    }

    /**
     * Destroy an authenticated session.
     */
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message'=> 'Admin Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.login')->with($notification);
    }

    //Admin Login Controller
    public function AdminLogin(){
        return view('admin.admin_login');
    }
    //Show Admin Profile
    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }

    //Add Inf and edit Profile Admin
    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        //upload file photo
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName(); //2003.avatar-2
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = 'upload/admin_images/'.$filename;
        }
        $data->save();

        $notification = array(
            'message'=> 'Admin Profile Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    // Admin change Password
    public function AdminChangePassword(){   
        $id = Auth::user()->id; 
        $profileData = User::find($id); 
        return view('admin.admin_change_password', compact('profileData'));
    }

        // Admin change Password
    public function AdminPasswordUpdate(Request $request){   
        //validation
        $request->validate([
            'old_password'=> 'required',
            'new_password' => 'required|confirmed',
        ]);
        if(!Hash::check($request->old_password, Auth::user()->password)){
            $notification = array(
                'message'=> 'Old Password Does not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        //update the new password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),   
        ]);
        $notification = array(
            'message'=> 'Update Password Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    //// Role In Permission

    public function AllAdminUser(){
        $roles = Role::all();
        $allAdmin = User::where('role', 'admin')->get();
        return view('backend.pages.all_admin_user', compact('allAdmin', 'roles'));
    }
    public function StoreAdminUser(Request $request){
        $oldUser = User::all();
        foreach($oldUser as $user){
            if($user->email === $request->email){
                $notification = array(
                    'message'=> 'Email Exists Error',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
        
        $roles = (int)$request->roles;
        if($roles){
            $user->assignRole($roles);
        }

        $notification = array(
            'message'=> 'Admin User Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditAdminUser($id) {
        $user = User::find($id);
        $roles = Role::all();
        $roleAdmin = '';
        foreach($roles as $role) {
            if($user->hasRole($role->name) == true) {
                $roleAdmin = $role->id;
            }
        }
        $data = ['user'=> $user, 'roleAdmin'=>$roleAdmin];
        return response()->json($data);
    }
    public function UpdateAdminUser(Request $request) {
        $id = $request->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        //delete assign role
        $user->roles()->detach();
        ///end delete

        $roles = (int)$request->roles; /// change role by Int
        if($roles){
            $user->assignRole($roles);
        }

        $notification = array(
            'message'=> 'Admin User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function DeleteAdminUser($id) {

        $user = User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        $notification = array(
            'message'=> 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
