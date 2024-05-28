<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order_details;
use App\Models\OrderMomo;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $data['order']= OrderMomo::get();
        return view("adminHT/order/index", $data);
    }
    public function order_details($id=null){
        $order_details= Order_details::where('order_id','=', $id)->get();

        $formattedOrders = [];
        foreach ( $order_details as $order) {
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

    public function add_order(){
       return view ('adminHT/order/add_order');
    }
    public function search_product(Request $request)
    {
        $query = $request->input('query');
        
        // Giả sử bạn có model Product và muốn tìm kiếm theo tên sản phẩm
        $products = Products::where('name', 'LIKE', "%{$query}%")->get();

        return response()->json($products);
    }

    public function search_account(Request $request)
    {
        $query = $request->input('query');
    
        $account = Order_details::where('fullname', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->groupBy('user_id')
            ->get(); // Lấy bản ghi đầu tiên
    
        return response()->json($account);
    }
    

    
    public function storeInSession(Request $request)
    {
        $request->session()->put('account_search_results', $request->input('results'));
        return response()->json(['success' => true]);
    }
    public function getSessionData(Request $request)
    {
        $data = $request->session()->get('account_search_results');
        dd($data); // Dump and die
    }
    

    
}
