@extends('manager.includes.admin-header')
	@section('content')
		<div class="container">
			@if(session()->has('project-message'))
	            <div class="alert alert-success alert-dismissible fade show" role="alert">
	                <strong>{{session()->get('project-message')}}</strong>
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
        	@endif

        	<h2 style="margin-top: 40px;margin-bottom: 40px;">Add A New Project</h2>

        	<form method="post" action="{{route('store-project')}}" class="center_div">
	            <div class="form-group">
	                <label for="project-name">Enter Name Of Project</label>
	                <input type="text" class="form-control" name="project-name" id="project-name" placeholder="Enter Project Name">
	            </div>
	            <div class="form-group">
	                <label for="client-name">Enter Client Name</label>
	                <input type="text" class="form-control" name="client-name" id="client-name" placeholder="Enter Client Name">
	            </div>
	            <div class="form-group">
	                <label for="client-contact">Enter Client's Contact Number</label>
	                <input type="tel" class="form-control" name="client-contact" id="client-contact" placeholder="Enter Client's Contact Number">
	            </div>
	            <div class="form-group">
	                <label for="client-email">Enter Client's Email</label>
	                <input type="email" class="form-control" name="client-email" id="client-email" placeholder="Enter Email">
	            </div>
	            <div class="form-group">
	                <label for="project-deadline">Enter Project Deadline</label>
	                <input type="date" class="form-control" name="project-deadline" id="project-deadline">
	            </div>
	            <div class="form-group">
	                <label for="department">Select A Department</label>
	                <select class="form-control" name="department" id="department">
	                    <option disabled selected value> -- select an option -- </option>
	                    @foreach($departments as $department)
	                    <option value="{{$department->id}}">{{$department->department_name}}</option>
	                    @endforeach
	                </select>
	            </div>
	            <div class="form-group">
	                <label for="manager">Select A Manager</label>
	                <select class="form-control" name="manager" id="manager">
	                    <option disabled selected value> -- select an option -- </option>
	                    @foreach($users as $user)
	                    <option value="{{$user->id}}">{{$user->name}}</option>
	                    @endforeach
	                </select>
	            </div>
	            <div class="form-group">
	                <label for="status">Project Status</label>
	                <select class="form-control" name="status" id="status">
	                    <option disabled selected value> -- select an option -- </option>
	                    <option value="New">New</option>
	                    <option value="Ongoing">Ongoing</option>
	                    <option value="Resolved">Resolved</option>
	                    <option value="Closed">Closed</option>
	                </select>
	            </div>
	            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
	            <button type="submit" class="btn btn-primary">Submit</button>
        	</form>
		</div>
	@endsection
@include('manager.includes.footer')