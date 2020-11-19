@extends('layouts.app')

@section('content')
    <div class="col-lg-10">
        @if(session()->has('user-message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session()->get('user-message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form method="post" action="{{route('store-user')}}">
            <div class="form-group">
                <label for="employee-name">Enter Name Of Employee</label>
                <input type="text" class="form-control" name="employee-name" id="employee-name" placeholder="Enter Employee Name">
            </div>
            <div class="form-group">
                <label for="user-email">Email address</label>
                <input type="email" class="form-control" id="user-email" aria-describedby="emailHelp" placeholder="Enter Email" name="user-email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <label for="employee-contact">Enter Employee Contact Number</label>
                <input type="tel" class="form-control" name="employee-contact" id="employee-contact" placeholder="Enter Employee Contact">
            </div>
            <div class="form-group">
                <label for="employee-pan">Enter Employee PAN Number</label>
                <input type="text" class="form-control" name="employee-pan" id="employee-pan" placeholder="Enter PAN Number">
            </div>
            <div class="form-group">
                <label for="emergency-contact">Enter Emergency Contact Name</label>
                <input type="text" class="form-control" name="emergency-contact" id="emergency-contact" placeholder="Enter Emergency Contact Name">
            </div>
            <div class="form-group">
                <label for="emergency-phone">Enter Emergency Contact's Phone</label>
                <input type="tel" class="form-control" name="emergency-phone" id="employee-phone" placeholder="Enter Emergency Phone Number">
            </div>
            <div class="form-group">
                <label for="blood-group">Blood Group</label>
                <input type="text" class="form-control" name="blood-group" id="blood-group" placeholder="Enter Blood Group">
            </div>
            <div class="form-group">
                <label for="permanent-address">Permanent Address</label>
                <input type="text" class="form-control" name="permanent-address" id="permanent-address" placeholder="Enter Permanent Address">
            </div>
            <div class="form-group">
                <label for="temporary-address">Temporary Address</label>
                <input type="text" class="form-control" name="temporary-address" id="temporary-address" placeholder="Enter Temporary Address">
            </div>
            <div class="form-group">
                <label for="citizenship-number">Citizenship Number</label>
                <input type="text" class="form-control" name="citizenship-number" id="citizenship-number" placeholder="Enter Citizenship Number">
            </div>
            <div class="form-group">
                <label for="role">Select A Role</label>
                <select class="form-control" name="role" id="role">
                    <option disabled selected value> -- select an option -- </option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Select A Status</label>
                <select class="form-control" name="status" id="status">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
