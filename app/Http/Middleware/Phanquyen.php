<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class Phanquyen
{
  
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();
    
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if ($user) {
            // Lặp qua các vai trò của người dùng và kiểm tra quyền
            foreach ($user->roles as $role) {
                // Kiểm tra xem vai trò có quyền cần thiết không
                if ($role->permissions->contains('name', $permission)) {
                    // Nếu có, cho phép tiếp tục xử lý request
                    return $next($request);
                }
            }
        }
    
        // Nếu người dùng không đăng nhập, không có vai trò, hoặc không có quyền, chuyển hướng đến trang không được phép
        return redirect()->route('ht.login');
    }
    
    // public function handle(Request $request, Closure $next): mixed
    // {
    //     if(Auth::check()){
    //         if(Auth::user()->role==1){
    //             return $next($request);
    //         }else{
    //             return redirect()->route('gd.home');
    //         }
    //     }else{
    //          return redirect()->route('ht.login');
    //      }
    // }
}
