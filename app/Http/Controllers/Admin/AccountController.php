<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $account = Account::with('roles')->get();

        return view("adminHT\account\index", compact('account'));
    }
    public function add_account(Request $request)
    {
        $messages = [
            'email.exists' => 'Email hoặc password không đúng! Vui lòng thử lại',
            'email.required' => 'Email không được bỏ trống!',
            'email.unique' => 'Email đã được đăng ký! Vui lòng dùng email khác !',
            'password.required' => 'Mật khẩu không được bỏ trống!',
            'Password.min' => 'Mật khẩu chưa đủ 6 ký tự!',
            'fullname.required' => 'Tên không được bỏ trống!',
            'phone.required' => 'Số điện thoại không được bỏ trống!',


        ];
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "fullname" => "required|max:32",
                "email" => "required|email|unique:account,email",
                "password" => "required|min:6|max:32",
                "phone" => "required|numeric|min:10",
                "role" => "required"
            ], $messages);
            $account = new Account();
            $account->fullname = $request->fullname;
            $account->email = $request->email;
            $account->phone = $request->phone;
            $account->password = bcrypt($request->password);
            $account->status = $request->status;
            $account->save();


            // Gán vai trò cho tài khoản
            $roleId = $request->input('role');
            $role = Role::find($roleId);

            if ($role) {
                DB::table('account_role')->insert([
                    'account_id' => $account->id,
                    'role_id' => $role->id
                ]);
            }

            toastr()->success('Đăng ký thành công');
            return redirect()->route("ht.account");

        }
        $data["role"] = Role::get();

        return view("adminHT\account\add_account", $data);
    }
    public function edit_account(Request $request, $id)
    {
        $messages = [
            'email.exists' => 'Email hoặc password không đúng! Vui lòng thử lại',
            'email.required' => 'Email không được bỏ trống!',
            'email.unique' => 'Email đã được đăng ký! Vui lòng dùng email khác!',
            'password.required' => 'Mật khẩu không được bỏ trống!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
            'fullname.required' => 'Tên không được bỏ trống!',
            'phone.required' => 'Số điện thoại không được bỏ trống!',
            'phone.numeric' => 'Số điện thoại phải là số!',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số!',
            'role.required' => 'Vui lòng chọn vai trò.',
        ];

        if ($request->isMethod("post")) {
            $this->validate($request, [
                "fullname" => "required|max:32",
                "email" => "required|email|unique:account,email," . $id,
                "password" => "nullable|min:6|max:32", // Password is optional for update
                "phone" => "required|numeric|min:10",
                "role" => "required",
            ], $messages);

            // tìm hoặc quăng lỗi fail
            $account = Account::findOrFail($id);
            if (Auth::user()->roles()->where('name_role', 'Quản trị viên')->exists()) {
                // Nếu là quản trị viên, kiểm tra xem có cố gắng cập nhật vai trò của chính mình không
                if (Auth::user()->id == $account->id) {
                    toastr()->error('Không thể cập nhật quản trị viên');
                    return redirect()->route('ht.account');
                }
            }
            // Update account details
            $account->fullname = $request->fullname;
            $account->email = $request->email;
            $account->phone = $request->phone;

            // Update password if được cung cấp
            if ($request->filled('password')) {
                $account->password = bcrypt($request->password);
            }
            $account->save();
            $roleId = $request->input('role');// lấy giá trị từ input role form ra
            $role = Role::find($roleId); //tìm biến $roleId có trong model role được lấy ra từ input form gán vào $role
            if ($role) { //nếu có $role thì xóa role hiện tại trong bảng account_role điều kiện account_id = $account ->id (id bảng account) 
                DB::table('account_role')->where('account_id', $account->id)->delete();
                // thêm role mới 
                DB::table('account_role')->insert([
                    'account_id' => $account->id,
                    'role_id' => $role->id
                ]);
            }

            toastr()->success('Cập nhật tài khoản thành công');
            return redirect()->route('ht.account');
        }

        // Load roles for the dropdown
        $data["role"] = Role::all();

        // Find the account to edit
        $data["account"] = Account::findOrFail($id);

        return view("adminHT\account\update_account", $data);
    }



    public function delete_account($id)
    {
        try {

            $loggedInUserId = auth()->user()->id;

            if ($id == $loggedInUserId) {
                toastr()->error('Bạn không thể tự xóa chính mình!');
                return redirect()->route('ht.account');
            }
            Account::destroy($id);

            toastr()->success('Xóa thành công!');
            return redirect()->route('ht.account');
        } catch (\Throwable $th) {
            toastr()->error('Đã xảy ra lỗi khi xóa tài khoản.');
            return redirect()->route('ht.account');
        }

    }


}
