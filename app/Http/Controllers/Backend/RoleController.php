<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
    public function allPermission(){
        $permission = Permission::all();
        return view('admin.backend.permission.all_permission', compact('permission'));
    }

    public function addPermission(){
        return view('admin.backend.permission.add_permission');
    }

    public function storePermission(Request $request){
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        
        $notification = array(
            'message' => 'Permission Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function editPermission($id){
        $permission = Permission::find($id);
        return view('admin.backend.permission.edit_permission', compact('permission'));
    }

    public function updatePermission(Request $request){
        $id = $request->id;
        Permission::find($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        
        $notification = array(
            'message' => 'Permission Berhasil diperbaharui',
            'alert-type' => 'success',
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function deletePermission($id){
        Permission::find($id)->delete();
        $notification = array(
            'message' => 'Permission Berhasil dihapus',
            'alert-type' => 'success',
        );
        return redirect()->route('all.permission')->with($notification);
    }


    // Roles
    public function allRoles(){
        $roles = Role::all();
        return view('admin.backend.roles.all_roles', compact('roles'));
    }

    public function addRoles(){
        return view('admin.backend.roles.add_roles');
    }

    public function storeRoles(Request $request){
        Role::create([
            'name' => $request->name,
        ]);

        
        $notification = array(
            'message' => 'Roles Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function editRoles($id){
        $roles = Role::find($id);
        return view('admin.backend.roles.edit_roles', compact('roles'));
    }

    public function updateRoles(Request $request){
        $id = $request->id;
        Role::find($id)->update([
            'name' => $request->name,
        ]);

        
        $notification = array(
            'message' => 'Roles Berhasil diperbaharui',
            'alert-type' => 'success',
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function deleteRoles($id){
        Role::find($id)->delete();
        $notification = array(
            'message' => 'Roles Berhasil dihapus',
            'alert-type' => 'success',
        );
        return redirect()->route('all.roles')->with($notification);
    }


    //Role Permission

    public function addRolesPermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        // dd($permission_groups);
        return view('admin.backend.rolesetup.add_role_permission', compact('roles', 'permission_groups', 'permissions'));
    }

    public function storeRolePermissios(Request $request){
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
           
        }  // End Foreach

         
        $notification = array(
            'message' => 'Roles Permission Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function allRolePermission(){
        $roles = Role::all();
        return view('admin.backend.rolesetup.all_role_permission', compact('roles'));
    }


    public function editRolePermission($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.backend.rolesetup.edit_role_permission', compact('role', 'permission_groups', 'permissions'));
    }

    public function updaterolesPermission(Request $request, $id){
        $role = Role::find($id);
        //dd($role);
        $permissions = $request->permission;
        //dd($permissions);
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $notification = array(
            'message' => 'Roles Permission Berhasil diperbahaui',
            'alert-type' => 'success',
        );
        return redirect()->route('all.role.permissions')->with($notification);
    }
}
