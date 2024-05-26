<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Giả sử bạn có model Product và muốn tìm kiếm theo tên sản phẩm
        $products = Products::where('name', 'LIKE', "%{$query}%")->get();

        return response()->json($products);
    }
}
