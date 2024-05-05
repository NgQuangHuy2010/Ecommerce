<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Products;
use Illuminate\Http\Request;

class User_ProductsController extends Controller
{
    public function product($id = null)
    {
        try {
            if ($id == 0) {
                $data['loadproduct'] = Products::paginate(6);
            } else {
                $data['loadproduct'] = Products::where('idcat', $id)->paginate(6);
          

            }
         

            // Chuyển đổi chuỗi JSON thành mảng cho trường images
            $data['loadproduct']->each(function ($product) {
                $product->images = json_decode($product->images, true);
            });
            return view("interface/pages/product", $data);
        } catch (\Throwable $th) {
            return redirect()->route('gd.home');
        }
    }
    public function sort($type)
{
    if ($type === 'asc') {
        $products = Products::orderBy('price', 'ASC')->paginate(6);
    } elseif ($type === 'desc') {
        $products = Products::orderBy('price', 'DESC')->paginate(6);
    } else {
        // Xử lý trường hợp không hợp lệ (nếu cần)
    }

    return view('interface.pages.product', ['loadproduct' => $products]);
}

}
