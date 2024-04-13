<?php

namespace App\Http\Controllers\Interface;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Products;

class HomeController extends Controller
{
    public function index()
    {

        $data["hotproducts"] = Products::take(4)->orderby("id", "desc")->get();         //lấy 8 sản phẩm và lọc theo id từ cao đến thấp
        $data["random"] = Products::inRandomOrder()->limit(4)->get();                     //hàm random sản phẩm ngẫu nhiên giới hạn là 4 sản phẩm
        $data["category"] = Categorie::with('products')->take(6)->get();    //lấy 6 danh mục từ bảng category
                                                                                    
        return view("interface/pages/home", $data);
    }



    
        public function product($id = null)
        {
            try {
                if ($id == 0) {
                    $data['loadproduct'] = Products::all();
                } else {
                    $data['loadproduct'] = Products::where('idcat', $id)->get();
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
    
    

    public function details($name=null,$id = null)
    {
        $data['details'] = Products::where('id', $id)->where('status', 1)->first();
        if ($data['details']) {
            $data["random"] = Products::where('idcat', $data['details']->idcat)->inRandomOrder()->limit(4)->get();   //hàm random sản phẩm trong details ngẫu nhiên giới hạn là 4 sản phẩm
            return view("interface/pages/details", $data);
        } else {
            return redirect()->route('gd.home');
        }


    }
    public function search(Request $request)
    {
        $search = $request->input('keyword');
        if (empty($search)) {                         // dùng empty kiểm tra xem biến search có trống ko
            return redirect()->route('gd.home');
        }
        $data['search'] = Products::where('status', 1)
            ->where('name', 'like', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")
            ->orWhere('desc', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->get();
        if ($data['search']->count() > 0) {               
            return view("interface/pages/search", $data);
        } else {
            return view("interface/pages/no_results", ['search' => $data['search'], 'request' => $request]);
        }
    }

    public function no_result()
    {
        return view("interface/pages/no_results");
    }
 

}
