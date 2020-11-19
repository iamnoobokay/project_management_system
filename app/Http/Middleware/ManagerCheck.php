<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()){
            if(Auth::user()->role_id==1 && Auth::user()->status==1){
                return $next($request);    
            }
            else{
                return redirect()->route('/')->with('message','Unauthorized Access!!');
            }
        }
        else{
            return redirect()->route('/')->with('message','Please Login As Project Manager');
        }
    }
}
