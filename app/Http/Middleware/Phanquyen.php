<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class Phanquyen
{
  
    public function handle(Request $request, Closure $next): mixed
    {
        if(Auth::check()){
            if(Auth::user()->role==1){
                return $next($request);
            }else{
                return redirect()->route('gd.home');
            }
        }else{
             return redirect()->route('ht.login');
         }
    }
}
