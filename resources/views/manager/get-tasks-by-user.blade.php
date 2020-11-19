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
			      <th scope="col">Deadline</th>
			      <th scope="col">Project</th>
			      <th scope="col">Action</th>
			    </tr>
		  	</thead>
  			<tbody>
  				<?php $i=1; ?>
  				@foreach($members as $member)
  					<?php $tasks=$member->tasks; ?>
  					@if(count($tasks)>0)
	  					@for($j=0;$j < count($tasks); $j++)
	  					@if($tasks[$j]->project->manager_id==Auth::user()->id)
	  						<tr>
								<th scope="row">{{$i}}</th>
			  					<td scope="row">{{$tasks[$j]->message}}</td>
			  					<td scope="row">{{$tasks[$j]->status}}</td>
			  					<td scope="row">{{$tasks[$j]->priority}}</td>
			  					<td scope="row">{{$tasks[$j]->deadline}}</td>
			  					<td scope="row">{{$tasks[$j]->project->project_name}}</td>
			  					<td scope="row">
  									<a href="{{route('change-task-status',['id'=>$tasks[$j]->id])}}" class="btn btn-secondary btn-sm mr-1 mb-1">Change Status</a>
  									<a href="{{route('change-task-priority',['id'=>$tasks[$j]->id])}}" class="btn btn-success btn-sm mr-1 mb-1">Change Priority</a>
  									<a href="{{route('task-delete',['id'=>$tasks[$j]->id])}}" class="btn btn-sm btn-danger mb-1">Delete</a>
  									<a href="{{route('extend-task-deadline',['id'=>$tasks[$j]->id])}}" class="btn btn-primary btn-sm mb-1">Extend Deadline</a>
			  					</td>
		    				</tr>
	  						<?php $i++; ?>
	  						@endif
	  					@endfor
  					@endif
    			@endforeach
			</tbody>
		</table>
	@endsection
@include('manager.includes.footer')