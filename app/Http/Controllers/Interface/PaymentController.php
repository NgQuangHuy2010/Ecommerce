<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class PaymentController extends Controller
{
    
    public function execPostRequest($url, $data)
    {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $_POST['total_momo'];           //$_POST['total_momo']
        $orderId = time() . "";
        $redirectUrl = "http://localhost:84/Ecommerce/payment/confirm";
        $ipnUrl = "http://localhost:84/Ecommerce/payment/confirm";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,

        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        // Redirect to MoMo payment URL
        $dateTime = Carbon::now();
        $userId = auth()->id();
        if (isset($jsonResult['payUrl'])) {

           // Chuyển hướng người dùng đến URL thanh toán của MoMo
            $request->session()->put('order', [
                'user_id' => $userId,
                'partnerCode' => $partnerCode,
                'orderId' => $orderId,
                'amount' => $amount,
                'orderInfo' => $orderInfo,
                'created_at' => $dateTime,
                'updated_at' => $dateTime

            ]);

           // dd($request->session()->get('order'));
            return redirect()->to($jsonResult['payUrl']);
        } else {
            // Xử lý lỗi khi không nhận được payUrl từ MoMo
            // Hoặc thực hiện các hành động khác tùy thuộc vào yêu cầu của ứng dụng
            return redirect()->back();
        }

    }



    public function confirmPayment(Request $request)
    {
       
        $ordermomo_sesion = $request->session()->get('order');
        DB::table('order_momo')->insert([
                    'user_id' =>  $ordermomo_sesion['user_id'],
                    'partner_code' =>  $ordermomo_sesion['partnerCode'],
                    'order_id' =>$ordermomo_sesion['orderId'],
                    'amount' => $ordermomo_sesion['amount'],
                    'order_info' => $ordermomo_sesion['orderInfo'],
                    'created_at' => $ordermomo_sesion['created_at'],
                    'updated_at' => $ordermomo_sesion['updated_at']
            ]);
            $order = DB::table('order_momo')->where('order_id', '=', $ordermomo_sesion['orderId'])->first();
            $bookingdetails = $request->session()->get('booking');
        DB::table('bookings')->insert([
                    'order_id' =>  $order->id,
                    'order_id_momo' => $ordermomo_sesion['orderId'],
                    'user_id' => $bookingdetails['user_id'],
                    'schedule_id' => $bookingdetails['schedule_id'],
                    'fullname' => $bookingdetails['fullname'],
                    'email' => $bookingdetails['email'],
                    'phone' => $bookingdetails['phone'],
                    'address' => $bookingdetails['address'],
                    'departurelocation' => $bookingdetails['departurelocation'],
                    'arrivallocation' => $bookingdetails['arrivallocation'],
                    'date_start' => $bookingdetails['date_start'],
                    'date_end' => $bookingdetails['date_end'],
                    'vehicle' => $bookingdetails['vehicle'],
                    'keyword' => $bookingdetails['keyword'],
                    'tour_code' => $bookingdetails['tour_code'],
                    'person1' => $bookingdetails['person1'],
                    'person2' => $bookingdetails['person2'],
                    'person3' => $bookingdetails['person3'],
                    'price1' => $bookingdetails['price1'],
                    'price2' => $bookingdetails['price2'],
                    'price3' => $bookingdetails['price3'],
                    'price0' => $bookingdetails['price0'],
                    'total_price' => $bookingdetails['total_price'],
                    'number_random' => $bookingdetails['random_number'],
                    'note' => $bookingdetails['note'],

                ]);

        $user_email = $request->session()->get('booking');
        $order = DB::table('bookings')->where('number_random', $user_email['random_number'])->first();
        // Gửi email
        Mail::send('mail.ordersuccess', ['order' => $order], function ($message) use ($user_email) {
            $message->to($user_email['email'])->subject("Thanh toán thành công");
        });
        // dd($order);
       
        
          
         $request->session()->forget('order');
         
        if (empty($request->session()->get('order'))) {
            $request->session()->put('payment_success', true);
            return redirect()->route('gd.home');

        }else{
            return view('interface.pages.thankyou');
        }
        
    
       
    }
}
