@extends('member.includes.header')
	@section('content')
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
		  						<a href="{{route('change-task-status-member',['id'=>$task->id])}}" class="btn btn-secondary btn-sm mr-1 mb-1">Change Status</a>
		  						<a href="{{route('task-send-message',['id'=>$task->id])}}" class="btn btn-primary btn-sm mr-1 mb-1">Send A Message</a>
		  					</td>
						</tr>
						<?php $i++; ?>
	    			@endforeach
				</tbody>
			</thead>
		</table>
	@endsection
@include('member.includes.footer')