@extends('manager.includes.admin-header')
	@section('content')
		<div class="col-md-12">
			@if(session()->has('project-message'))
	            <div class="alert alert-success alert-dismissible fade show" role="alert">
	                <strong>{{session()->get('project-message')}}</strong>
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
        	@endif
			<div class="card" style="margin-bottom: 30px">
				<div class="card-header">
					<h4>Project Details</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<h5>{{$project->project_name}}</h5>
							<h6>Project Manager: {{$projectManager->name}}</h6>
							<br>
							<p>Department: {{$project->department->department_name}}</p>
							<p>Status: {{$project->status}}</p>
							<p>Deadline: {{$project->deadline}}</p>
						</div>
						<div class="col-md-6">
							<h5>Client Information</h5>
							<h6>Client Name: {{$project->client_name}}</h6>
							<br>
							<p>Client Contact: {{$project->client_contact}}</p>
							<p>Client Email: {{$project->client_email}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h5>Select Project Members</h5>
							</div>
							<div class="card-body">
								<form method="post" action="{{route('add-project-members',['id'=>$project->id])}}">
									@foreach($users as $user)
										@if(Auth::user()->id!=$user->id)
											@if(in_array($user->id,$projectMembersArray))
												<div class="form-group">
													<input type="checkbox" id="{{$user->id}}" name="members[]" value="{{$user->id}}" checked>
													<label for="{{$user->id}}">{{$user->name}}</label>
												</div>
											@else
												<div class="form-group">
													<input type="checkbox" id="{{$user->id}}" name="members[]" value="{{$user->id}}">
													<label for="{{$user->id}}">{{$user->name}}</label>
												</div>
											@endif
										@endif
									@endforeach
									<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
	            					<button type="submit" class="btn btn-primary">Submit</button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h5>Change Project Status</h5>
							</div>
							<div class="card-body">
								<form method="post" action="{{route('change-project-status',['id'=>$project->id])}}">
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
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection
@include('manager.includes.footer')