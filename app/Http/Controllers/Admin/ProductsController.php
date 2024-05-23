<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categorie;


class ProductsController extends Controller
{
  public function products()
  {
    

    $data["products"] = Products::with('categories')->get();
    return view("adminHT/products/products", $data);
  }
  public function add(Request $request)
  {
    if ($request->isMethod("post")) {
      $this->validate($request, [
        "name" => "required",
        "keyword" => "required",
        "desc" => "required",
        "price" => "required|numeric",
        'image' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
      
      ]);
      $prod = new Products();
      $prod->name = $request->name;
      $prod->keyword = $request->keyword;
      $prod->desc = $request->desc;
      $prod->content = $request->content;
      $prod->price = $request->price;
      if ($request->hasFile("image")) {
        $img = $request->file("image");
        $nameimage = time() . "_" . $img->getClientOriginalName();
        //move vao thu vien public
        $img->move('public/file/img/img_product/', $nameimage);



        //gan ten hinh anh vao cot image
        $prod->image = $nameimage;
      }
      if($request->hasfile('images')) {
        foreach($request->file('images') as $file){
            $name=time().'_at_'.$file->getClientOriginalName();
            $file->move('public/file/img/img_product/',$name); 
            $image[] = $name;  
          
        }
        $prod->images=json_encode($image);
}
      // $prod->images = $request->images;
      $prod->idcat = $request->idcat;
      // $prod->datecreate = time();
      // $prod->dateedit = time();
      $prod->status = $request->status;
      $prod->save();
      toastr()->success(' More success!');
      // Session::flash('note','Successfully !');
      return redirect()->route("ht.products");
    } else {
      $data["cate"] = Categorie::where("status", 1)->get();
    return view("adminHT/products/addpro", $data);
    }

    
  }
  public function update(Request $request, $id)
  {
    $data["load"] = Products::find($id);
    if ($request->isMethod("post")) {
      $this->validate($request, [
        "name" => "required",
        "keyword" => "required",
        "desc" => "required",
        "price" => "required|numeric",
        'image' => 'mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
        // "idcat" => "required",
        // "datecreate" => "required",
        // "dateedit" => "required",
      ]);
      $edit = Products::find($id);
      $edit->name = $request->name;
      $edit->keyword = $request->keyword;
      $edit->desc = $request->desc;
      if ($request->hasFile("image")) {
        $img = $request->file("image");
        $nameimage = time() . "_" . $img->getClientOriginalName();
        //xoa hinh cu
        @unlink('public/file/img/img_product/'.$data["load"]->image);
        //move vao thu vien public
        $img->move('public/file/img/img_product/', $nameimage);
        //gan ten hinh anh vao cot image
        $edit->image = $nameimage;
      }

      if($request->hasfile('images')) {
        if($edit->images!=""){
          foreach (json_decode($edit->images) as $key) {
            @unlink('public/file/img/img_product/'.$key);
          }
        }
        foreach($request->file('images') as $file){
            $name=time().'_at_'.$file->getClientOriginalName();
            $file->move('public/file/img/img_product/',$name); 
            $image[] = $name;
              
        }
        $edit->images=json_encode($image);
}
      $edit->price = $request->price;
      $edit->idcat = $request->idcat;
     
      $edit->status = $request->status;
      $edit->content = $request->content;
      $edit->save();
      toastr()->success(' Update success!');
      return redirect()->route("ht.products");
    } else {
      $data["cate"] = Categorie::where("status", 1)->get();
      return view("adminHT/products/updateprod", $data);
    }

  }
  public function delete($id)
  {
    try {
      $load = Products::find($id);
      @unlink('public/file/img/img_product/'.$load->image);
      Products::destroy($id);
      toastr()->success('Delete success !');
      return redirect()->route('ht.products'); //chuyen ve trang category
    } catch (\Throwable $th) {

      return redirect()->route('ht.products'); //chuyen ve trang category
    }
  }

}
