<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Session;
use App\Models\Order;
use App\Models\Orderdetails;
use Auth;

class CartController extends Controller
{
    public function cart(Request $request, $id = null)
    {
        return view("interface/pages/cart");
    }
    public function addcart(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $id = $request->id;
            $sp = Products::find((int) $request->id);
            if ($sp) {
                if ($request->soluong) {
                    $soluong = $request->soluong;
                } else {
                    $soluong = 1;
                }
                $item = array(
                    'id' => $sp->id,
                    'name' => $sp->name,
                    'image' => $sp->image,
                    'price' => $sp->price,
                    'soluong' => $soluong
                );
                $cart = Session::put('cart.' . $sp->id, $item);
                return response()->json('cart-success');
            }
        }
        return response()->json('cart successfully');
    }
    public function delcart($id = null)
    {
        if (Session::exists('cart.' . (int) $id)) {
            Session::forget('cart.' . (int) $id);
            return redirect()->route('gd.cart');
        } else {
            return redirect()->route('gd.home');
        }
    }
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
        return view("interface/pages/checkout");
    }
}
