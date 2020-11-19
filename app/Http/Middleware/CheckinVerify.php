<?php

namespace App\Http\Middleware;

use Closure;
use App\Checkin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckinVerify
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
            $checkin=Checkin::where('user_id',Auth::user()->id)->where('date',Carbon::now('Asia/Kathmandu')->format('Y,m,d'))->get();
            if(count($checkin)==0){
                if(Auth::user()->role_id==1){
                    return redirect()->route('checkin-checkout-view')->with('checkin-message',"Please Checkin Before Starting A Task");
                }
                else{
                    return redirect()->route('checkin-checkout-view')->with('checkin-message',"Please Checkin Before Starting A Task");
                }
            }
        }
        return $next($request);
    }
}
