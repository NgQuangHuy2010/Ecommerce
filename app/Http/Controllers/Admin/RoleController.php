<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index_role(){
        $data["role"]=Role::get();
        return view("adminHT/role/index_role",$data);
    }
    public function add_role(Request $request){
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name_role' => 'required',

            ]);
            $role = new Role();
            $role->name_role = $request->name_role;
            $role->account_id=1;
            $role->save();
            toastr()->success(' Tạo mới thành công!');
            return redirect()->route("ht.role");
        }
        return view("adminHT/role/add_role");

    }
}
