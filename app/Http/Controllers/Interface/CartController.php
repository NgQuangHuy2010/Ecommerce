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

}
