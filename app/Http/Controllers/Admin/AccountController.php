<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $data["account"] = Account::get();
        return view("adminHT\account\index", $data);
    }
    public function add_account(Request $request)
    {
        return view("adminHT\account\add_account");
    }
    public function edit_account(Request $request)
    {

    }
    public function delete_account($id)
    {
        try {

            $loggedInUserId = auth()->user()->id;

            if ($id == $loggedInUserId) {
                toastr()->error('Bạn không thể tự xóa chính mình!');
                return redirect()->route('ht.account');
            }
            Account::destroy($id);

            toastr()->success('Xóa thành công!');
            return redirect()->route('ht.account');
        } catch (\Throwable $th) {
            toastr()->error('Đã xảy ra lỗi khi xóa tài khoản.');
            return redirect()->route('ht.account');
        }

    }


}
