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
use Illuminate\Support\Facades\Validator;

class SecureController extends Controller
{
    public function login(Request $request)
    {

        if ($request->isMethod('post')) {
            $messages = [
                'email.exists' => 'Email hoặc password không đúng! Vui lòng thử lại',
                'email.required' => 'Email không được bỏ trống!',
                'password.required' => 'Mật khẩu không được bỏ trống!',
                'Password.min' => 'Mật khẩu chưa đủ 6 ký tự!'


            ];
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:account,email',
                'password' => 'required|alpha_num|min:6|max:32',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator, 'login')
                    ->withInput($request->only('email'));
            }

            $email = $request->email;
            $password = $request->password;
            $remember = $request->remember;

            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                if (Auth::user()->status == 1) {
                    toastr()->success('Đăng nhập thành công');
                    return redirect()->route('gd.home');

                } else {
                    Auth::logout();
                    return redirect()->back()
                        ->withErrors(['login' => 'Tài khoản bị cấm'])
                        ->withInput($request->only('email'));
                }
            } else {
                return redirect()->route('gd.home')
                    ->with('registration_success', true)
                    ->withErrors(['email' => 'Email hoặc password không đúng! Vui lòng thử lại'])
                    ->withInput($request->only('email'));
            }
        } else {
            return view("interface/pages/home");
        }

    }


    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'email.exists' => 'Email hoặc password không đúng! Vui lòng thử lại',
                'email.required' => 'Email không được bỏ trống!',
                'email.unique' => 'Email đã được đăng ký! Vui lòng dùng email khác !',
                'password.required' => 'Mật khẩu không được bỏ trống!',
                'Password.min' => 'Mật khẩu chưa đủ 6 ký tự!',
                'fullname.required' => 'Tên không được bỏ trống!',
                'phone.required' => 'Số điện thoại không được bỏ trống!',


            ];
            $validator = Validator::make($request->all(), [
                "fullname" => "required|max:32",
                "email" => "required|email|unique:account,email",
                "password" => "required|min:6|max:32",
                "phone" => "required|numeric|min:10",
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator, 'register')
                    ->withInput();
            }

            $register = new Account();
            $register->fullname = $request->fullname;
            $register->email = $request->email;
            $register->password = bcrypt($request->password);
            $register->phone = $request->phone;
            
            $register->save();

            toastr()->success('Đăng ký thành công');
            return redirect()->route('gd.home')->with('registration_success', true);
        } else {

            return view("interface/pages/home");
        }
    }





    public function logout()
    {
        return redirect()->route('gd.home')->with(Auth::logout());
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

    public function forgetPassword()
    {
        return view("interface/pages/forget-password");

    }
    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:account,email",
        ]);
        $token = Str::random(64);
        DB::table('forget_password')->insert([
            'email' => $request->email,
            'token' => $token,

        ]);
        Mail::send("mail.sendmail", ['token' => $token], function ($messages) use ($request) {
            $messages->to($request->email);
            $messages->subject("Reset Password");

        });
        toastr()->success('Email đã được gửi!');
        return redirect()->route("gd.forget");

    }
    function resetPassword($token)
    {
        return view("interface/pages/new-password", compact('token'));

    }
    function resetPasswordPost(Request $request)
    {
        $messages = [
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp!!',
        ];
        $request->validate([
            'email' => "required|email|exists:account,email",
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'

        ], $messages);

        $updatePassword = DB::table('forget_password')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$updatePassword) {
            return redirect()->route("gd.resetPassword");

        }
        Account::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('forget_password')->where(["email" => $request->email])->delete();
        toastr()->success('Thay đổi password thành công!');
        return redirect()->route("gd.login");

    }

    public function historyOrder()
    {
        if (auth()->check()) {
            $userId = auth()->id(); // Lấy ID của người dùng đã đăng nhập

            $orders = DB::table('order_shop')
                ->join('order_details_shop', 'order_shop.order_id', '=', 'order_details_shop.order_id_momo')
                ->where('order_shop.user_id', $userId)
                ->select('order_shop.*', 'order_details_shop.*')
                ->get();
            // chuyển mảng thành chuỗi
            $formattedOrders = [];
            foreach ($orders as $order) {
                $formattedProducts = [];
                $products = json_decode($order->products, true);
                foreach ($products as $product) {
                    $formattedProducts[] = $product['name_product'] . ' x' . $product['quantity'];
                }
                $order->formatted_products = implode(', ', $formattedProducts);
                $formattedOrders[] = $order;
            }
            return view('interface.pages.history_order', ['orders' => $formattedOrders]);
        }
    }

    public function searchOrder(Request $request)
    {
        if ($request->isMethod('get')) {
            // Xử lý khi phương thức là GET (hiển thị form tìm kiếm)
            return view('interface.pages.searchform_order');
        } elseif ($request->isMethod('post')) {
            // Xử lý khi phương thức là POST (thực hiện tìm kiếm)
            $order_id_momo = $request->input('order_id_momo');
    
            $order = DB::table('order_shop')
                ->join('order_details', 'order_shop.order_id', '=', 'order_details.order_id_momo')
                ->where('order_shop.order_id', $order_id_momo)
                ->select('order_shop.*', 'order_details.*')
                ->get();
    
            if ($order->isNotEmpty()) {
                // Tìm thấy đơn hàng, trả về trang history_order.blade.php với dữ liệu đơn hàng
                $formattedOrders = $order->map(function ($order) {
                    $formattedProducts = collect(json_decode($order->products, true))
                        ->map(function ($product) {
                            return $product['name_product'] . ' x' . $product['quantity'];
                        })
                        ->implode(', ');
    
                    $order->formatted_products = $formattedProducts;
                    return $order;
                });
    
                return view('interface.pages.history_order', ['orders' => $formattedOrders]);
            } else {
                // Không tìm thấy đơn hàng, trả về trang history_order.blade.php với cảnh báo
                return redirect()->route('gd.history')->with('order_not_found', true);
            }
        }
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