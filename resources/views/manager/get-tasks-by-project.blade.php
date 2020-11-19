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
				<th scope="col">Status</th>
		      	<th scope="col">Priority</th>
		      	<th scope="col">Assigned To</th>
		      	<th scope="col">Deadline</th>
		      	<th scope="col">Actions</th>
			</tr>

			<tbody>
  				<?php $i=1; ?>
  				@foreach($tasks as $task)
					<tr>
						<th scope="row">{{$i}}</th>
	  					<td scope="row">{{$task->message}}</td>
	  					<td scope="row">{{$task->status}}</td>
	  					<td scope="row">{{$task->priority}}</td>
	  					<td scope="row">{{$task->members->user->name}}</td>
	  					<td scope="row">{{$task->deadline}}</td>
	  					<td>
	  						<a href="{{route('change-task-status',['id'=>$task->id])}}" class="btn btn-secondary btn-sm mr-1 mb-1">Change Status</a>
  							<a href="{{route('change-task-priority',['id'=>$task->id])}}" class="btn btn-success btn-sm mr-1 mb-1">Change Priority</a>
  							<a href="{{route('task-delete',['id'=>$task->id])}}" class="btn btn-sm btn-danger mr-1 mb-1">Delete</a>
  							<a href="{{route('extend-task-deadline',['id'=>$task->id])}}" class="btn btn-primary btn-sm mb-1">Extend Deadline</a>
	  					</td>
					</tr>
					<?php $i++; ?>
    			@endforeach
			</tbody>
		</thead>
	</table>
	@endsection
@include('manager.includes.footer')