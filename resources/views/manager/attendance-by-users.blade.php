@extends('manager.includes.admin-header')
	@section('content')
		<table class="table table-striped">
		  	<thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			      <th scope="col">From</th>
			      <th scope="col">To</th>
			      <th scope="col">Action</th>
			    </tr>
		  	</thead>
  			<tbody>
  				<?php $i=1; ?>
  				@foreach($users as $user)
    			<tr>
					<th scope="row">{{$i}}</th>
  					<td>{{$user->name}}</td>
  					<form method="post" action="{{route('attendance-by-date',['id'=>$user->id])}}">
  						<td>
  							<input type="date" name="from" class="form-control" required>
  						</td>
  						<td>
  							<input type="date" name="to" class="form-control" required>
  						</td>
  						<td>
  							<button type="submit" class="btn btn-primary">Submit</button>
  						</td>
  						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
  					</form>
    			</tr>
    			<?php $i++; ?>
    			@endforeach
			</tbody>
		</table>
		
	@endsection
@include('manager.includes.footer')