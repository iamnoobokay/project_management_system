@extends('manager.includes.header')
	@section('content')
		@if(session()->has('task-message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session()->get('task-message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
		<form method="POST" action="{{route('task-store',['id'=>$project->id])}}">
			<div class="form-group">
                <label for="member">Select Member</label>
                <select class="form-control" name="member" id="member" required>
                	<option disabled selected value> -- select an option -- </option>
	                @foreach($project->members as $member)
	                	<option value="{{$member->id}}">{{$member->user->name}}</option>
	                @endforeach
            	</select>
            </div>
            <div class="form-group">
            	<label for="deadline">Set Deadline</label>
				<input type="date" name="deadline" id="deadline" class="form-control" required> 
            </div>
            <div class="form-group">
                <label for="priority">Set Priority</label>
                <select class="form-control" name="priority" id="priority" required>
                	<option disabled selected value> -- select an option -- </option>
	                <option value="High">High</option>
	                <option value="Medium">Medium</option>
	                <option value="Low">Low</option>
            	</select>
            </div>
            <div class="form-group">
	            <label for="status">Task Status</label>
				<select class="form-control" name="status" id="status" required>
					<option disabled selected value> -- select an option -- </option>
                    <option value="New">New</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Closed">Closed</option>
                </select>
			</div>
			<div class="form-group">
                <label for="message">Task Details</label>
            	<input type="text" class="form-control" name="message" id="message" placeholder="Enter Task Details" required>
	        </div>

	        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	@endsection
@include('manager.includes.footer')