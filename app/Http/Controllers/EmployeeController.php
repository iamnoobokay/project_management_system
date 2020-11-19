<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::all();
        return view('manager.user-add')->with('roles',$roles)->with('user-message');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'employee-name'=>'required',
            'user-email'=>'required',
            'password'=>'required',
            'employee-contact'=>'required',
            'employee-pan'=>'required',
            'emergency-contact'=>'required',
            'emergency-phone'=>'required',
            'blood-group'=>'required',
            'permanent-address'=>'required',
            'temporary-address'=>'required',
            'citizenship-number'=>'required',
            'dob'=>'required',
            'role'=>'required',
            'status'=>'required',
        ]);

        $password=bcrypt($request->input('password'));

        $user=new User();
        $user->name=$request->input('employee-name');
        $user->email=$request->input('user-email');
        $user->password=$password;
        $user->contact_number=$request->input('employee-contact');
        $user->pan_number=$request->input('employee-pan');
        $user->emergency_contact=$request->input('emergency-contact');
        $user->emergency_contact_phone=$request->input('emergency-phone');
        $user->blood_group=$request->input('blood-group');
        $user->permanent_address=$request->input('permanent-address');
        $user->temporary_address=$request->input('temporary-address');
        $user->citizenship_number=$request->input('citizenship-number');
        $user->date_of_birth=$request->input('dob');
        $user->role_id=$request->input('role');
        $user->status=$request->input('status');
        $user->save();

        return redirect()->route('user-add')->with('user-message','User Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users=User::all();
        $roles=Role::all();
        return view('manager.users-view',compact('users','roles'))->with('user-message');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        return view('manager.user-update',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'employee-name'=>'required',
            'user-email'=>'required',
            'employee-contact'=>'required',
            'employee-pan'=>'required',
            'emergency-contact'=>'required',
            'emergency-phone'=>'required',
            'blood-group'=>'required',
            'permanent-address'=>'required',
            'temporary-address'=>'required',
            'citizenship-number'=>'required',
            'dob'=>'required',
        ]);

        if($request->input('password')){
            $password=bcrypt($request->input('password'));
        }
        $user=User::find($id);
        $user->name=$request->input('employee-name');
        $user->email=$request->input('user-email');
        if($request->input('password')){
            $user->password=$password;
        }
        $user->contact_number=$request->input('employee-contact');
        $user->pan_number=$request->input('employee-pan');
        $user->emergency_contact=$request->input('emergency-contact');
        $user->emergency_contact_phone=$request->input('emergency-phone');
        $user->blood_group=$request->input('blood-group');
        $user->permanent_address=$request->input('permanent-address');
        $user->temporary_address=$request->input('temporary-address');
        $user->citizenship_number=$request->input('citizenship-number');
        $user->date_of_birth=$request->input('dob');
        $user->save();

        return redirect()->route('user-show')->with('user-message','User Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('user-show')->with('user-message','User Deleted Successfully');
    }

    public function changeStatus($id){
        $user=User::find($id);
        if($user->status==1){
            $user->status=0;
            $user->save();
        }
        elseif($user->status==0){
            $user->status=1;
            $user->save();
        }
        return redirect()->route('user-show')->with('user-message','User Status Updated Successfully!!');
    }

    public function changeRole($id){
        $user=User::find($id);

        if($user->role_id==1){
            $user->role_id=2;
            $user->save();
        }

        elseif($user->role_id==2){
            $user->role_id=3;
            $user->save();
        }

        elseif($user->role_id==3){
            $user->role_id=1;
            $user->save();
        }

        return redirect()->route('user-show')->with('user-message','User Role Updated Successfully!!');
    }

    public function checkBirthday(){
        $users=User::all();
        $i=0;
        $dob=[];
        foreach($users as $user){
            $dateofbirth = substr($user->date_of_birth, 5);
            $dateofbirth=str_replace('-', ',' , $dateofbirth);
            $today=Carbon::now()->format('m,d');
            if($dateofbirth==$today){
                array_push($dob,$user->name);
            }
        }
        return $dob;
    }
}
