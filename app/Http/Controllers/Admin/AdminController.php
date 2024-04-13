<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("adminHT/admin/index");
    }
    public function add(Request $request){
        return view("adminHT/admin/add");
    
      }
      public function update(Request $request,$id){
        return view("adminHT/admin/update");
    
      }  
      public function delete($id){}
}
