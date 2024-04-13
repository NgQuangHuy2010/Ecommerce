<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Auth;
use Bcrypt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\Sendmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class SecureController extends Controller
{
    public function login(Request $request)
    {

        if ($request->isMethod('post')) {
            $messages = [
                'email.exists' => 'email or password is incorrect',   //'exists'kiểm tra xem email có tồn tại ko, nếu ko tồn tại in lỗi
                // 'email.required' => 'ko dc de trong',
            ];
            $this->validate($request, [
                'email' => 'required|email|exists:account,email',
                'password' => 'required|alpha_num|min:6|max:32',
            ], $messages);

            $email = $request->email;
            $password = $request->password;
            $remember = $request->remember;
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {


                if (Auth::user()->status == 1) {
                    toastr()->success('Login success');
                    return redirect()->route('gd.home');
                } else {
                    Auth::logout();
                    echo "tài khoản bị cấm";
                }
            } else {
                return redirect()->route('gd.login')
                    ->withErrors(['email' => 'Email or password is incorrect']) //Được sử dụng để đặt các thông báo lỗi cho người dùng.
                    ->withInput($request->only('email')); //Được sử dụng để giữ lại giá trị trong ô input khi ngdùng nhập sai "dùng hàm only() để giữ lại ô input mình cần giữ"
            }

        } else {
            return view("interface/pages/login");
        }


    }
    public function logout()
    {
        return redirect()->route('gd.home')->with(Auth::logout());
    }
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                "fullname" => "required|min:6|max:32",
                "address" => "required|min:6|max:150",
                "email" => "required|unique:account,email",
                "username" => "required|alpha_num|min:6|max:32",
                "password" => "required",
                "phone" => "required",

            ]);
            $register = new Account();
            $register->fullname = $request->fullname;
            $register->address = $request->address;
            $register->email = $request->email;
            $register->username = $request->username;
            $register->password = bcrypt($request->password);
            $register->phone = $request->phone;
            $register->role = 0;
            $register->save();
            toastr()->success('Dang ky thanh cong');
            return redirect()->route("gd.login");
        } else {
            return view("interface/pages/register");
        }
    }

    // function test()
    // {

    //     $mailData = [
    //         'title' => 'Khôi phục mật khẩu',
    //         'body' => 'Yêu cầu khôi phục mật khẩu của bạn tại web.com đã được chấp nhận.',
    //     ];
    //     Mail::to('nqht123456789@gmail.com')->send(new Sendmail($mailData));
    //     dd('Email send success');
    // }

public function forgetPassword(){
    return view("interface/pages/forget-password");

}
public function forgetPasswordPost(Request $request){
    $request->validate([
        'email'=>"required|email|exists:account,email",
    ]);
    $token=Str::random(64);
    DB::table('forget_password')->insert([
        'email'=>$request->email,
        'token'=>$token,
        
    ]);
    Mail::send("mail.sendmail",['token'=>$token],function($messages) use($request){
        $messages->to($request->email);
        $messages->subject("Reset Password");

    });
    toastr()->success('Email đã được gửi!');
    return redirect()->route("gd.forget");

}
function resetPassword($token){
    return view("interface/pages/new-password",compact('token'));

}
function resetPasswordPost(Request $request){
    $messages = [
        'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp!!',   
    ];
    $request->validate([
        'email'=>"required|email|exists:account,email",
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required'

    ],$messages);

    $updatePassword =DB::table('forget_password')->where([
        'email' =>$request ->email,
        'token' =>$request ->token
    ])->first();

    if(!$updatePassword){
    return redirect()->route("gd.resetPassword");
        
    }
    Account::where('email',$request->email)->update(['password'=> Hash::make($request->password)]);
    DB::table('forget_password')->where(["email"=> $request->email])->delete();
    toastr()->success('Thay đổi password thành công!');
    return redirect()->route("gd.login");
    
}
















}
// \Config::set('app.name', "Khoi phuc mat khau");
// \Config::set('app.url', "http://web.com");
// \Config::set('mail.driver', 'smtp');
// \Config::set('mail.port', 587);
// \Config::set('mail.encryption', 'tls');
// \Config::set('mail.host', 'smtp.gmail.com');
// \Config::set('mail.username', "nqht123456789@gmail.com");
// \Config::set('mail.password', "hftr dolk cibg uwrv");
// $data = [
//     'title' => 'Khôi phục mật khẩu',
//     'mota' => 'Yêu cầu khôi phục mật khẩu của bạn tại web.com đã được chấp nhận.',
//     'dulieu' => 'Mật khẩu mới của bạn là ' . $password,
// ];
// Mail::to($mail)->send(new Sendmail($data));