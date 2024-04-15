<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoController extends Controller
{
 
    public function index()
    {
        $logo = Logo::get();
        return view('adminHT/logo/index', compact('logo'));
    }
    
    
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'image' => 'required|mimes:jpeg,png,gif,jpg,ico|max:4096',

            ]);
            $logo = new Logo();
            if ($request->hasFile("image")) {
                $img = $request->file("image");
                $nameimage = time() . "_" . $img->getClientOriginalName();
                //move vao thu vien public
                $img->move('public/file/img/img_logo/', $nameimage);
                //gan ten hinh anh vao cot image
                $logo->image = $nameimage;
            }
            $logo->save();
            toastr()->success(' Tạo mới thành công!');
            return redirect()->route("ht.logo");
        }
        return view('adminHT/logo/add_logo');
    }
    public function update(Request $request, $id = null)
    {
        $olddata["display"] = Logo::find($id);
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'image' => 'required|mimes:jpeg,png,gif,jpg,ico|max:4096',

            ]);
            $edit = Logo::find($id);
            if ($request->hasFile("image")) {
                $img = $request->file("image");
                $nameimage = time() . "_" . $img->getClientOriginalName();
                //xoa hinh cu
                @unlink('public/file/img/img_logo/' . $olddata["display"]->image);
                //move vao thu vien public
                $img->move('public/file/img/img_logo/', $nameimage);
                //gan ten hinh anh vao cot image
                $edit->image = $nameimage;
            } else {
                $edit->image = $olddata["display"]->image;
            }
            $edit->save();
            toastr()->success(' Update success!');
            return redirect()->route("ht.logo");
        }
        return view('adminHT/logo/update_logo', $olddata);

    }
    public function delete($id){
try {
    $load=Logo::find($id);
    @unlink('public/file/img/img_logo/'.$load->image);
    Logo::destroy($id);
      toastr()->success('Xóa thành công !');
      return redirect()->route('ht.logo');

} catch (\Throwable $th) {
    return redirect()->route('ht.logo');

}
    }
}
