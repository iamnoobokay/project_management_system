@extends('member.includes.header')
	@section('content')
		<table class="table table-striped">
		  	<thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Project Name</th>
			      <th scope="col">Actions</th>
			    </tr>
		  	</thead>
  			<tbody>
  				<?php $i=1; ?>
  				@foreach($projects as $project)
  					<tr>
  						<th scope="row">{{$i}}</th>
  						<td scope="row">{{$project->project_name}}</td>
  						<td scope="row"><a class="btn btn-primary btn-sm mr-1" href="{{route('tasks-by-project',['id'=>$project->id])}}">View Tasks</a></td>
  					</tr>
  					<?php $i++; ?>
    			@endforeach
			</tbody>
		</table>
	@endsection
@include('member.includes.footer')