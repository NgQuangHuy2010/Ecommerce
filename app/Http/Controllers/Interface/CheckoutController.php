<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Models\Order;
use App\Models\Orderdetails;
use Auth;
class CheckoutController extends Controller
{
    public function checkout(Request $request){
        if($request->isMethod('post')){
            $order=new Order();
            $order->id_user=Auth::user()->id;
            $order->ship=10;
            $order->total=2000;
            $order->payment=$request->payment;
            $order->timeship=7;
            $order->note="";
            $order->date_order=date('d/m/Y',strtotime(date('Y-m-d H:i:s')));
            $order->status_order=1;
            $order->save();
            foreach (Session::get('cart') as $key => $value) {
                $ctdh=new Orderdetails();
                $ctdh->quantity=(int)$value['soluong'];
                $ctdh->id_order=(int)$order->id;
                $ctdh->id_product=(int)$value['id'];
                $ctdh->status=1;
                $ctdh->save();
            }
            return redirect()->route('gd.home');
        }
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
}
