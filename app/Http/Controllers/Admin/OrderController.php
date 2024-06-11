<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order_details;
use App\Models\OrderMomo;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $data['order'] = OrderMomo::get();
        return view("adminHT/order/index", $data);
    }
    public function order_details($id = null)
    {
        $order_details = Order_details::where('order_id', '=', $id)->get();

        $formattedOrders = [];
        foreach ($order_details as $order) {
            $formattedProducts = [];
            $products = json_decode($order->products, true);
            foreach ($products as $product) {
                $formattedProducts[] = $product['name_product'] . ' x' . $product['quantity'];
            }
            $order->formatted_products = implode(', ', $formattedProducts);
            $formattedOrders[] = $order;
        }
        return view('adminHT/order/order_details', ['order_details' => $formattedOrders]);


    }

    public function add_order(Request $request)
    {
        $apiController = new OrderController();
        $locations = $apiController->getLocations($request);

        return view('adminHT/order/add_order', compact('locations'));
    }

    public function getLocations(Request $request)
    {
        $json = Storage::get('json_data/VN.json');
        $locations = json_decode($json, true);

        // Trả về dữ liệu
        return $locations;

    }
    public function saveOrderNew(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);


        // lưu session vào Shipment_Details
        $request->session()->put('shipment_details', [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'province' => $request->selected_province,
            'district' => $request->selected_district,
            'ward' => $request->selected_ward,
            'orderId' => $request->random_number,
        ]);
        // Lấy thông tin hiện có trong session
        $shipmentDetails = $request->session()->get('shipment_details', []);

        // Giải mã chuỗi JSON thành mảng sản phẩm
        $products = json_decode($request->products, true);

        // Thêm thông tin sản phẩm vào mảng shipment_details
        $shipmentDetails['products'] = $products;

        // Lưu totalPayment vào mảng shipment_details
        // Loại bỏ tất cả các ký tự không phải là số
        $shipmentDetails['totalPayment'] = preg_replace('/\D/', '', $request->totalPayment);



        // Lưu lại mảng vào session
        $request->session()->put('shipment_details', $shipmentDetails);
        //dd($request->session()->get('shipment_details'));
        $dateTime = Carbon::now();
        $userId = auth()->id();
        //return response()->json(['message' => 'Products and Total Payment saved to session successfully']);
        $saveOrder = $request->session()->get('shipment_details');
        DB::table('order_shop')->insert([
            'user_id' => $userId,
            'partner_code' => 'TM1234567',
            'order_id' => $saveOrder['orderId'],
            'amount' => $saveOrder['totalPayment'],
            'order_info' => 'Thanh toán bằng tiền mặt',
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
            'message' => 'Chưa thanh toán'
        ]);
        $order = DB::table('order_shop')->where('order_id', '=', $saveOrder['orderId'])->first();
        $order_details = $request->session()->get('shipment_details');
        if ($order_details) {
            // khởi tạo mảng trống
            $products = [];
            //$order_details['products'] là mảng chứa tất cả các sản phẩm
            // $order_details chứa khóa products khóa này có các chi tiết từng mảng sản phẩm (mảng trong mảng), vòng lặp duyệt qua từng mảng gán vào $item và thêm vào $products[] 
            foreach ($order_details['products'] as $item) {
                $products[] = $item;
            }
            DB::table('order_details_shop')->insert([
                'order_id' => $order->id,
                'user_id' => $userId,
                'order_id_momo' => $saveOrder['orderId'],
                'fullname' => $order_details['fullname'],
                'email' => $order_details['email'],
                'phone' => $order_details['phone'],
                'address' => $order_details['address'],
                'province' => $order_details['province'],
                'district' => $order_details['district'],
                'ward' => $order_details['ward'],
                'total_price' => $order_details['totalPayment'],
                'number_random' => 1,
                'products' => json_encode($products), //chứa theo dạng json
            ]);
        }

        toastr()->success(' Tạo mới đơn hàng thành công!');
        return redirect()->back();

    }

    public function search_product(Request $request)
    {
        $query = $request->input('query');

        // Giả sử bạn có model Product và muốn tìm kiếm theo tên sản phẩm
        $products = Products::where('name', 'LIKE', "%{$query}%")->get();

        return response()->json($products);
    }







}





