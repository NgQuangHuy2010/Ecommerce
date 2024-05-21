<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Models\Order;
use App\Models\Orderdetails;
use Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
       
        $apiController = new CheckoutController();
        $locations = $apiController->getApi($request);
        return view("interface/pages/checkout", compact('locations'));
    }
    public function getApi(Request $request)
    {
        $json = Storage::get('json_data/VN.json');
        $locations = json_decode($json, true);

        // Trả về dữ liệu
        return $locations;

    }
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
    public function save_information(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
        // vòng lặp duyệt qua từng sản phẩm trong giỏ hàng
        foreach (Session::get("cart") as $item) {
            // Thêm sản phẩm và số lượng được duyệt vào $product
            $products[] = [
                'name_product' => $item['name'],
                'quantity' => $item['soluong'],

            ];
        }
        $randomNumber = mt_rand(0, 999999);
        // lưu session vào Shipment_Details
        $request->session()->put('shipment_details', [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'province' => $request->selected_province,
            'district' => $request->selected_district,
            'ward' => $request->selected_ward,
            'total_price' => $request->total_price,
            'random_number' => $randomNumber,

            'products' => $products, // $product[] dc lấy ra để lưu vào session
        ]);

        // Check if the data is stored correctly
        //dd($request->session()->get('shipment_details'));


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
            // dd($request->session()->get('shipment_details'));

            return redirect()->to($jsonResult['payUrl']);
        } else {
            // Xử lý lỗi khi không nhận được payUrl từ MoMo
            // Hoặc thực hiện các hành động khác tùy thuộc vào yêu cầu của ứng dụng
            return redirect()->back();
        }
    }



}
