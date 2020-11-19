<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
    	return view('login');
    }

    public function loginVerification(Request $request){
    	$this->validate($request,[
    		'email'=>'required',
    		'password'=>'required',
    	]);
    	$userdata=array(
    		'email'=>$request->input('email'),
    		'password'=>$request->input('password')
    	);
    	if(Auth::attempt($userdata)){
    		if(Auth::user()->role_id==1 &&Auth::user()->status==1){
    			return redirect()->route('checkin-checkout-view')->with('checkin-message','Please Checkin Before Starting A Task');
    		}
			elseif(Auth::user()->role_id==2 && Auth::user()->status==1){
				return redirect()->route('checkin-checkout-view')->with('checkin-message','Please Checkin Before Starting A Task');
			}
            elseif(Auth::user()->role_id==3 && Auth::user()->status==1){
                return redirect()->route('checkin-checkout-view')->with('checkin-message','Please Checkin Before Starting A Task');
            }
			elseif((Auth::user()->role_id==1 || Auth::user()->role_id==2 || Auth::user()->role_id==3) && Auth::user()->status==0){
				return redirect()->route('/')->with('message','Sorry Your Account Has Been Deactivated');
			}
    	}
    	else{
    		return redirect()->route('/')->with('message','Sorry The Email Or Password Field Did Not Match');
    	}
    }

    public function logout(){
		if(Auth::user()){
			Auth::logout();
			return redirect()->route('/')->with('message','Logged Out Successfully');
		}
    }
}
