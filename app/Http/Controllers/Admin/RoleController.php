<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index_role()
    {
        $data["role"] = Role::get();
        return view("adminHT/role/index_role", $data);
    }
    public function add_role_view()
    {
        return view("adminHT/role/add_role");
    }
    public function add_role(Request $request) //function thêm role bằng post
    {
        $message = [
            'permissions.required' => "Bạn phải chọn ít nhất 1 quyền",
        ];
        // Validate the request
        $request->validate([
            'name_role' => 'required|string|max:255',
            'permissions' => 'array|required|min:1',
        ], $message);

        // Create the role
        $role = Role::create([
            'name_role' => $request->input('name_role'),
        ]);
        // Attach permissions to the role
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('name', $request->input('permissions'))->get();
            $role->permissions()->attach($permissions);
        }
        toastr()->success('Thêm thành công!');
        return redirect()->route('ht.role');
    }

    public function delete_role($id)
    {
        try {

            $loggedInUserId = auth()->user()->id;

            if ($id == $loggedInUserId) {
                toastr()->error('Không thể xóa quản trị viên!');
                return redirect()->route('ht.role');
            }
            Role::destroy($id);
            toastr()->success('Xóa thành công!');
            return redirect()->route('ht.role');
        } catch (\Throwable $th) {
            toastr()->error('Đã xảy ra lỗi khi xóa tài khoản.');
            return redirect()->route('ht.role');
        }
    }

    public function update_role_view($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('adminHT/role/update_role', compact('role', 'permissions'));
    }

    public function update_role(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Kiểm tra xem tài khoản có phải là quản trị viên không
        if (Auth::user()->roles()->where('name_role', 'Quản trị viên')->exists()) {
            // Nếu là quản trị viên, kiểm tra xem có cố gắng cập nhật vai trò của chính mình không
            if (Auth::user()->id == $role->id) {
                toastr()->error('Không thể cập nhật quản trị viên');
                return redirect()->route('ht.role');
            }
        }

        // Tiếp tục xử lý nếu không phải là quản trị viên hoặc không cố gắng cập nhật vai trò của chính mình
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array|min:1',
        ], [
            'permissions.required' => 'Bạn phải chọn ít nhất một quyền.',
            'permissions.min' => 'Bạn phải chọn ít nhất một quyền.',
        ]);

        // Cập nhật lại tên vai trò
        $role->name_role = $request->input('name');
        $role->save();

        // Tạo một mảng để lưu trữ ID của các quyền được chọn
        $permissionIds = [];

        // Lặp qua các tên quyền được gửi từ form và tìm kiếm các ID tương ứng
        foreach ($request->input('permissions') as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
            if ($permission) {
                $permissionIds[] = $permission->id;
            }
        }

        // Cập nhật lại quyền cho vai trò
        $role->permissions()->sync($permissionIds);

        // Chuyển hướng sau khi cập nhật thành công
        return redirect()->route('ht.role');
    }





}
