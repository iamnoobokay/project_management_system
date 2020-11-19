@extends('manager.includes.header')
	@section('content')
		<table class="table table-striped">
		  	<thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">User Name</th>
			      <th scope="col">Actions</th>
			    </tr>
		  	</thead>
  			<tbody>
  				<?php $i=0; ?>
  				@foreach($users as $user)
	    			<tr>
						<th scope="row">{{$i}}</th>
	  					<td scope="row">{{$user->name}}</td>
	  					<td scope="row">
	  						<a class="btn btn-primary btn-sm mr-1" href="{{route('get-task-by-user',['id'=>$user->id])}}">View Assigned Tasks</a>
	  					</td>
	    			</tr>
    			<?php $i++; ?>
    			@endforeach
			</tbody>
		</table>
	@endsection
@include('manager.includes.footer')