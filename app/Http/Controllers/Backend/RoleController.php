<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    //

    public function AllPermission()
    {

        $permissions= Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }


    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request)
    {
         Permission::create([
            'name'=> $request->name,
            'group_name'=> $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission created successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->route('all.permission')->with($notification);
    
    }

    public function EditPermission($id)
    {

        $permission = Permission::findorfail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }

    public function UpdatePermission(Request $request)
    {
        $per_id= $request->id;

         Permission::findorfail($per_id)->update([
            'name'=> $request->name,
            'group_name'=> $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->route('all.permission')->with($notification);
    
    }


    public function DeletePermission($id)
    {
        Permission::findorfail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
    

    }


    // For the role all method

    public function AllRoles()
    {
        $roles = Role::all();
        return view('backend.pages.roles.all_roles', compact('roles'));


    }

    public function AddRoles()
    {
        return view('backend.pages.roles.add_roles');
    }

    
    public function StoreRoles(Request $request)
    {
         Role::create([
            'name'=> $request->name,
            
        ]);

        $notification = array(
            'message' => 'Role created successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->route('all.roles')->with($notification);
    
    }

    public function EditRoles($id)
    {

        $roles = Role::findorfail($id);
        return view('backend.pages.roles.edit_roles',compact('roles'));
    }

    public function UpdateRoles(Request $request)
    {
        $rol_id= $request->id;

         Role::findorfail($rol_id)->update([
            'name'=> $request->name,
            
        ]);

        $notification = array(
            'message' => 'Role Updated successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->route('all.roles')->with($notification);
    
    }

    public function DeleteRole($id)
    {
        Role::findorfail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
    

    }


    // Add Role Permission All Method

        public function AddRolesPermission()
        {
            $roles = Role::all();
            $permission = Permission::all();
            $permission_groups= User::getPermissionGroups();
            return view('backend.pages.rolesetup.add_roles_permission',compact('roles','permission','permission_groups'));
        }


        public function RolePermissionStore(Request $request)
        {
            $data = array();
            $permissions = $request->permission;

            foreach($permissions as $key => $item)
            {
                    $data['role_id'] = $request->role_id;
                    $data['permission_id'] = $item;
            }

            DB::table('role_has_permissions')->insert($data);

            $notification = array(
                'message' => 'Role Permission Added successfully',
                'alert-type' => 'success'
                );
        
                return redirect()->route('all.roles.permission')->with($notification);
        

        }

        public function AllRolesPermission()
        {
            $roles=Role::all();
            return view('backend.pages.rolesetup.all_roles_permission',compact('roles'));
        }

        public function AdminEditRoles($id)
        {
            $role = Role::findorfail($id);
            $permission = Permission::all();
            $permission_groups= User::getPermissionGroups();
            return view('backend.pages.rolesetup.edit_roles_permission',compact('role','permission','permission_groups'));
        }





}
