<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $data["banner"] = Banner::get();
        return view("adminHT/banner/index", $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod("POST")) {
            $this->validate($request, [
                'image_first' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'image_second' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'image_third' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
            ]);
            $banner = new Banner();
            $images = ['image_first', 'image_second', 'image_third'];    //tạo mảng chứa 3 trường name trong form html
            foreach ($images as $imageField) {  //dùng vòng lặp duyệt mảng
                if ($request->hasFile($imageField)) {  //kiểm tra xem đúng tên trường từ form gửi lên http ko
                    $img = $request->file($imageField);
                    $nameimage = time() . "_" . $img->getClientOriginalName();
                    // Di chuyển tệp vào thư mục public
                    $img->move('public/file/img/img_banner/', $nameimage);
                    // Gán tên hình ảnh vào trường tương ứng
                    $banner->{$imageField} = $nameimage;
                }
            }

            $banner->save();
            toastr()->success(' Tạo mới thành công!');
            return redirect()->route("ht.banner");

        }
        return view("adminHT/banner/add_banner");
    }

    public function update(Request $request, $id = null)
    {
        $olddata["display"] = Banner::find($id);
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'image_first' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'image_second' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'image_third' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',

            ]);
            $edit = Banner::find($id);
            $images = ['image_first', 'image_second', 'image_third'];    //tạo mảng chứa 3 trường name trong form html
            foreach ($images as $imageField) {  //dùng vòng lặp duyệt mảng
                if ($request->hasFile($imageField)) {  //kiểm tra xem đúng tên trường từ form gửi lên http ko
                    $img = $request->file($imageField);
                    $nameimage = time() . "_" . $img->getClientOriginalName();

                    @unlink('public/file/img/img_banner/' . $olddata["display"]->$imageField);

                    // Di chuyển tệp vào thư mục public
                    $img->move('public/file/img/img_banner/', $nameimage);
                    // Gán tên hình ảnh vào trường tương ứng
                    $edit->{$imageField} = $nameimage;
                } else {
                    $edit->$imageField = $olddata["display"]->$imageField;

                }
            }
            $edit->save();
            toastr()->success(' Cập nhật thành công!');
            return redirect()->route("ht.banner");
        }
        return view('adminHT/banner/update_banner', $olddata);

    }

    public function delete($id)
    {
        try {
            $load = Banner::find($id);
            $images = ['image_first', 'image_second', 'image_third'];    //tạo mảng chứa 3 trường name trong form html
            foreach ($images as $imageField) {
                @unlink('public/file/img/img_banner/' . $load->$imageField);

            }
            Banner::destroy($id);
            toastr()->success('Xóa thành công !');
            return redirect()->route('ht.banner');

        } catch (\Throwable $th) {
            return redirect()->route('ht.banner');

        }
    }

}