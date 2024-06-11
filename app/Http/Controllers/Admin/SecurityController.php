<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'email.exists' => 'Email hoặc mật khẩu sai.Vui lòng nhập lại',
                'email.required' => 'Vui lòng nhập email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất có 6 ký tự',

            ];
            $this->validate($request, [
                'email' => 'required|email|exists:account,email',
                'password' => 'required|alpha_num|min:6|max:32',
            ], $messages);

            $email = $request->email;
            $password = $request->password;

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                if (Auth::user()->status == 1) {
                    toastr()->success('Đăng nhập thành công!');
                    foreach (Auth::user()->roles as $role) {
                        if ($role->permissions->contains('name', 'manage_orders')) {
                            return redirect()->route('ht.admin');
                        } elseif ($role->permissions->contains('name', 'manage_products')) {
                            return redirect()->route('ht.categorie');
                        } elseif ($role->permissions->contains('name', 'manage_logo')) {
                            return redirect()->route('ht.logo');
                        } elseif ($role->permissions->contains('name', 'manage_banner')) {
                            return redirect()->route('ht.banner');
                        } elseif ($role->permissions->contains('name', 'manage_accounts')) {
                            return redirect()->route('ht.account');
                        }
                    }
                } else {
                    Auth::logout();
                    echo "tài khoản bị cấm";
                }
            } else {
                return redirect()->route('ht.login')
                    ->withErrors(['email' => 'Email hoặc mật khẩu sai.Vui lòng nhập lại']) //Được sử dụng để đặt các thông báo lỗi cho người dùng.
                    ->withInput($request->only('email')); //Được sử dụng để giữ lại giá trị trong ô input khi ngdùng nhập sai "dùng hàm only() để giữ lại ô input mình cần giữ"
            }

        } else {
            return view("adminHT/security/login");
        }

    }
    public function logout()
    {
        return redirect()->route('ht.login')->with(Auth::logout());
    }
}



