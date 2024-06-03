<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mail;

class PaymentController extends Controller
{
    public function Payment(Request $request)
    {
        $ordermomo_sesion = $request->session()->get('order');
        DB::table('order_momo')->insert([
            'user_id' => $ordermomo_sesion['user_id'],
            'partner_code' => $ordermomo_sesion['partnerCode'],
            'order_id' => $ordermomo_sesion['orderId'],
            'amount' => $ordermomo_sesion['amount'],
            'order_info' => $ordermomo_sesion['orderInfo'],
            'created_at' => $ordermomo_sesion['created_at'],
            'updated_at' => $ordermomo_sesion['updated_at'],
            'message' => $ordermomo_sesion['message']
            
        ]);
        $order = DB::table('order_momo')->where('order_id', '=', $ordermomo_sesion['orderId'])->first();
        $order_details = $request->session()->get('shipment_details');
        if ($order_details) {
            // khởi tạo mảng trống
            $products = [];
            //$order_details['products'] là mảng chứa tất cả các sản phẩm
            // $order_details chứa khóa products khóa này có các chi tiết từng mảng sản phẩm (mảng trong mảng), vòng lặp duyệt qua từng mảng gán vào $item và thêm vào $products[] 
            foreach ($order_details['products'] as $item) {
                $products[] = $item;
            }
            DB::table('order_details')->insert([
                'order_id' => $order->id,
            'user_id' => $ordermomo_sesion['user_id'],
                'order_id_momo' => $ordermomo_sesion['orderId'],
                'fullname' => $order_details['fullname'],
                'email' => $order_details['email'],
                'phone' => $order_details['phone'],
                'address' => $order_details['address'],
                'province' => $order_details['province'],
                'district' => $order_details['district'],
                'ward' => $order_details['ward'],
                'total_price' => $order_details['total_price'],
                'number_random' => $order_details['random_number'],
                'products' => json_encode($products), //chứa theo dạng json
            ]);
        }
        $user_email = $request->session()->get('shipment_details');
        //random để so sánh nếu giống nhau thì gửi mail ,cột number_random =  $user_email['random_number'] trong session
        $order = DB::table('order_details')->where('number_random', $user_email['random_number'])->first();
        // Gửi email
        Mail::send('mail.ordersuccess', ['order' => $order], function ($message) use ($user_email) {
            $message->to($user_email['email'])->subject("Thanh toán thành công");
        });
        // dd($order);
        //xóa session order và cart
        $request->session()->forget('order');
        $request->session()->forget('cart');
        //sau khi thnh toán thành công return về home và hiện thông báo cho user
        if (empty($request->session()->get('order'))) {
            $request->session()->put('payment_success', true);
            return redirect()->route('gd.home');

        } else {
            return view('interface.pages.confirmPay');
        }



    }
}
