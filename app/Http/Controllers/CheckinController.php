<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Checkin;
use Carbon\Carbon;
use App\User;

class CheckinController extends Controller
{
    public function index(){
    	if(Auth::user()->role_id==1){
    		return view('manager.checkin-checkout');
    	}
        elseif(Auth::user()->role_id==3){
            return view('manager.admin-checkin-checkout');
        }
    	else{
    		return view('member.checkin-checkout');
    	}
    }

    public function checkin(){
    	$user=Auth::user();
    	$validate=Checkin::where('user_id',$user->id)->where('date',Carbon::now('Asia/Kathmandu')->format('Y,m,d'))->get();

    	if($validate->isEmpty()==true){
    		$timestamp =Carbon::now('Asia/Kathmandu');
			$time = $timestamp->format('H:i:s');
			$date=$timestamp->format('Y-m-d');

			$checkin=new Checkin();
			$checkin->checkin=$time;
			$checkin->date=$date;
			$checkin->user_id=$user->id;
			$checkin->save();

			if($user->role_id==1){
				return redirect()->route('checkin-checkout-view')->with('checkin-message',"You Have Checked In For Today");
			}
			else{
				return redirect()->route('checkin-checkout-view')->with('checkin-message',"You Have Checked In For Today");
			}
    	}
    	else{
    		if($user->role_id==1){
    			return redirect()->route('checkin-checkout-view')->with('checkin-message',"You are already checked in");
    		}
    		else{
    			return redirect()->route('checkin-checkout-view')->with('checkin-message',"You Have Checked In For Today");
    		}
    	}
    }

    public function checkout(Request $request){
    	$this->validate($request,[
            'tasks-completed'=>'required',
            'tomorrow-task'=>'required',
        ]);

    	$user=Auth::user();
    	$checkinTime=Checkin::where('user_id',$user->id)->where('date',Carbon::now('Asia/Kathmandu')->format('Y,m,d'))->first();
    	if($checkinTime!=null){
    		$timestamp=Carbon::now('Asia/Kathmandu');
		   	$time=$timestamp->format('H:i:s');
		   	$checkinTime->checkout=$time;

		   	$checkin=strtotime($checkinTime->checkin);
		   	$checkoutTime=strtotime($time);

		   	$seconds=$checkoutTime-$checkin;
		    $hours=$seconds/3600;

		    $checkinTime->hours=$hours;
		    $checkinTime->work_details=$request->input('tasks-completed');
		    $checkinTime->tomorrow_work=$request->input('tomorrow-task');
			$checkinTime->save();

			if($user->role_id==1){
				return redirect()->route('checkin-checkout-view')->with('checkin-message',"Bye Bye ".Auth::user()->name);
			}
			else{
				return redirect()->route('checkin-checkout-view')->with('checkin-message',"Bye Bye ".Auth::user()->name);
			}
    	}
    	else{
    		return redirect()->route('checkin-checkout-view')->with('checkin-message',"Seems Like You Forgot To Check In Today. Please Contact Your Project Manager");
    	}
    }

    public function todayAttendance(){
    	$attendances=Checkin::where('date',Carbon::now('Asia/Kathmandu')->format('Y,m,d'))->get();
    	foreach($attendances as $attendance){
    		$attendance->user;
    	}
    	return view('manager.today-attendance',compact('attendances'));
    }

    public function attendanceByUsers(){
    	$users=User::all();
    	return view('manager.attendance-by-users',compact('users'));
    }

    public function attendanceByDate(Request $request,$id){
    	$this->validate($request,[
            'from'=>'required',
            'to'=>'required'
        ]);
        $attendances=Checkin::where('user_id',$id)->where('date','>=',$request->input('from'))->where('date','<=',$request->input('to'))->get();
        return view('manager.attendance-by-date',compact('attendances'));
    }

    public function attendanceIndividualDate(){
    	$attendances=[];
    	return view('manager.attendance-individual-date',compact('attendances'));
    }

    public function attendanceIndividualShow(Request $request){
    	$this->validate($request,[
            'date'=>'required',
        ]);
        $attendances=Checkin::where('date',$request->input('date'))->get();
        return view('manager.attendance-individual-date',compact('attendances'));
    }
}
