@extends('manager.includes.admin-header')
	@section('content')
		@if(session()->has('project-message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session()->get('project-message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    	@endif
		<table class="table table-striped">
		  	<thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Project Name</th>
			      <th scope="col">Deadline</th>
			      <th scope="col">Status</th>
			      <th scope="col">Department</th>
			      <th scope="col">Actions</th>
			    </tr>
		  	</thead>
  			<tbody>
  				<?php $i=1; ?>
  				@foreach($projects as $project)
    			<tr>
					<th scope="row">{{$i}}</th>
  					<td>{{$project->project_name}}</td>
  					<td>{{$project->deadline}}</td>
  					<td>{{$project->status}}</td>
  					<td>{{$project->department->department_name}}</td>
  					<td>
  						<a href="{{route('manage-project',['id'=>$project->id])}}" class="btn btn-sm btn-primary">Manage</a>
  						<a href="{{route('project-edit',['id'=>$project->id])}}" class="btn btn-sm btn-secondary">Edit</a>
  						<a href="{{route('project-delete',['id'=>$project->id])}}" class="btn btn-sm btn-danger">Delete</a>
  					</td>
    			</tr>
    			<?php $i++; ?>
    			@endforeach
			</tbody>
		</table>
	@endsection
@include('manager.includes.footer')