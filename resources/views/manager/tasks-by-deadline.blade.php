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
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Message</th>
					<th scope="col">Project</th>
					<th scope="col">Status</th>
			      	<th scope="col">Priority</th>
			      	<th scope="col">Assigned To</th>
			      	<th scope="col">Deadline</th>
			      	<th scope="col">Actions</th>
				</tr>

				<tbody>
	  				<?php $i=1; ?>
	  				@foreach($tasksArray as $taskCollection)
	  					@foreach($taskCollection as $task)
								<tr>
									<th scope="row">{{$i}}</th>
				  					<td scope="row">{{$task->message}}</td>
				  					<td scope="row">{{$task->project->project_name}}</td>
				  					<td scope="row">{{$task->status}}</td>
				  					<td scope="row">{{$task->priority}}</td>
				  					<td scope="row">{{$task->members->user->name}}</td>
				  					<td scope="row">{{$task->deadline}}</td>
				  					<td>
				  						@if($task->status != "Closed")
				  						<a href="{{route('change-task-status',['id'=>$task->id])}}" class="btn btn-secondary btn-sm mr-1 mb-1">Change Status</a>
				  						@endif
				  						@if($task->status=="Closed" && $task->project->manager_id==Auth::user()->id)
				  						<a href="{{route('change-task-status',['id'=>$task->id])}}" class="btn btn-secondary btn-sm mr-1 mb-1">Change Status</a>
				  						@endif
				  						@if($task->project->manager_id!=Auth::user()->id)
				  						<a href="{{route('task-send-message-manager',['id'=>$task->id])}}" class="btn btn-primary btn-sm mr-1 mb-1">Send A Message</a>
				  						@endif
				  					</td>
								</tr>
								<?php $i++; ?>
						@endforeach
	    			@endforeach
				</tbody>
			</thead>
		</table>
	@endsection
@include('manager.includes.footer')