<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Session;

class CategorieController extends Controller
{
  public function categorie()
  {
    $data["categorie"] = Categorie::get();
    return view("adminHT/categorie/category", $data);
  }
  public function add(Request $request)
  {
    if ($request->isMethod("post")) {
      $this->validate($request, [
        "name" => "required",
        "keyword" => "required",
        // 'image' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
        "desc" => "required",
       

      ]);
      $cate = new Categorie();
      $cate->name = $request->name;
      $cate->keyword = $request->keyword;
      $cate->desc = $request->desc;
   
      $cate->status = $request->status;
      // if ($request->hasFile("image")) {
      //   $img = $request->file("image");
      //   $nameimage = time() . "_" . $img->getClientOriginalName();
      //   //move vao thu vien public
      //   $img->move('public/file/img/img_category/', $nameimage);
      //   //gan ten hinh anh vao cot image
      //   $cate->image = $nameimage;
      // }
      $cate->save();
      toastr()->success(' More success!');
      // Session::flash('note','Successfully !');
      return redirect()->route("ht.categorie");
    }
    return view("adminHT/categorie/add");

  }
  public function update(Request $request, $id = null)
  {
    $olddata["display"] = Categorie::find($id);
    if ($request->isMethod("post")) {
      $this->validate($request, [
        "name" => "required",
        "keyword" => "required",
        // 'image' => 'mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
        "desc" => "required",
      
      ]);
      $edit = Categorie::find($id);
      $edit->name = $request->name;
      $edit->keyword = $request->keyword;
      // if ($request->hasFile("image")) {
      //   $img = $request->file("image");
      //   $nameimage = time() . "_" . $img->getClientOriginalName();
      //   //xoa hinh cu
      //   @unlink('public/file/img/img_category/'.$olddata["display"]->image);
      //   //move vao thu vien public
      //   $img->move('public/file/img/img_category/',$nameimage);
      //   //gan ten hinh anh vao cot image
      //   $edit->image = $nameimage;
      // }else{
      //   $edit->image=$olddata["display"]->image;
      // }
      $edit->desc = $request->desc;

      $edit->status = $request->status;
      $edit->save();
      toastr()->success(' Update success!');
      return redirect()->route("ht.categorie");
    } else {
      return view("adminHT/categorie/update", $olddata);
    }

  }
  public function delete($id)
  {
    try {
      // $load = Categorie::find($id);
      // @unlink('public/file/img/img_category/'.$load->image);
      Categorie::destroy($id);
      toastr()->success('Delete success !');
      return redirect()->route('ht.categorie'); //chuyen ve trang category
    } catch (\Throwable $th) {

      return redirect()->route('ht.categorie'); //chuyen ve trang category
    }
  }

}
