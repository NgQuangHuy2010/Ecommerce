<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index_role(){
        $data["role"]=Role::get();
        return view("adminHT/role/index_role",$data);
    }
    public function add_role_view(){
        // if ($request->isMethod('POST')) {
        //     $this->validate($request, [
        //         'name_role' => 'required|unique',

        //     ]);
        //     $role = new Role();
        //     $role->name_role = $request->name_role;
        //     $role->account_id=1;
        //     $role->save();
        //     toastr()->success(' Tạo mới thành công!');
        //     return redirect()->route("ht.role");
        // }
        return view("adminHT/role/add_role");

    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name_role' => 'required|string|max:255',
            'permissions' => 'array',
        ]);

        // Create the role
        $role = Role::create([
            'name_role' => $request->input('name_role'),
        ]);

        // Attach permissions to the role
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('name', $request->input('permissions'))->get();
            $role->permissions()->attach($permissions);
        }

        return redirect()->route('ht.role')->with('success', 'Role created successfully');
       

    }

}
