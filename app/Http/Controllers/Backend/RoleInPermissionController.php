<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleInPermissionController extends Controller
{
    //Permission 
    public function AllPermission(){
        $permissions = Permission::latest()->get();
        return view('backend.pages.all_permission', compact('permissions'));
    }

    public function StorePermission(Request $request){
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message'=> 'Permission Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('permission.all')->with($notification);
    }

    
    public function EditPermission($id){
        $data = Permission::find($id);
        return response()->json($data);
    }

    public function UpdatePermission(Request $request){
        $permission = Permission::find($request->id);
        $permission->name = $request->name;
        $permission->group_name = $request->group_name;
        $permission->save();
        $notification = array(
            'message'=> 'Permission Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('permission.all')->with($notification);
    }

    public function DeletePermission($id){
        $permissions = Permission::find($id)->delete();
        $notification = array(
            'message'=> 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('permission.all')->with($notification);
    }

    //  Role Methods
    public function AllRole(){
        $roles = Role::latest()->get();
        return view('backend.pages.all_role', compact('roles'));
    }

    public function StoreRole(Request $request){
        Role::create([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message'=> 'Role Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.all')->with($notification);
    }

    
    public function EditRole($id){
        $data = Role::find($id);
        return response()->json($data);
    }

    public function UpdateRole(Request $request){
        $permission = Role::find($request->id);
        $permission->name = $request->name;
        $permission->save();
        $notification = array(
            'message'=> 'Role Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.all')->with($notification);
    }

    public function DeleteRole($id){
        $permissions = Role::find($id)->delete();
        $notification = array(
            'message'=> 'Role Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.all')->with($notification);
    }

    // Role In Permission
    public function AllRoleInPermission(){
        $roles = Role::latest()->get();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.all_role_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function StoreRoleInPermission(Request $request){
        $data = array();
        $permissions = $request->permission;
    
        foreach ($permissions as $permission){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $permission;
            DB::table('role_has_permissions')->insert($data);
        } // end foreach

        $notification = array(
            'message'=> 'Roles Permission Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.permission.all')->with($notification);
        
    }
    public function EditRoleInPermission($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.edit_role_permission', compact('role', 'permissions', 'permission_groups'));

   }

   public function UpdateRoleInPermission(Request $request, $id){
       $role = Role::find($id);
       $permissions = $request->input('permission');

       $permissions = array_map(function ($item) {
       return (int)$item;
       }, $permissions);
       // dd($permissions);
       
       if (!empty($permissions)){
       $role->syncPermissions($permissions);
       }
       $notification = array(
           'message'=> 'Roles Admin Updated Successfully',
           'alert-type' => 'success'
       );
       return redirect()->route('role.permission.all')->with($notification);

  }

   public function DeleteRoleInPermission($id){
       $role = Role::find($id);
       if(!is_null($role)){
           $role->delete();
       }
       $notification = array(
           'message'=> 'Roles Admin Deleted Successfully',
           'alert-type' => 'success'
       );
       return redirect()->route('role.permission.all')->with($notification);
   }
}
