@extends('manager.includes.admin-header')
	@section('content')
		@if(session()->has('user-message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session()->get('user-message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
	    @endif
		<table class="table table-striped">
		  	<thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">Status</th>
			      <th scope="col">Role</th>
			      <th scope="col">Actions</th>
			    </tr>
		  	</thead>
  			<tbody>
  				<?php $i=1; ?>
  				@foreach($users as $user)
    			<tr>
					<th scope="row">{{$i}}</th>
  					<td>{{$user->name}}</td>
  					<td>{{$user->email}}</td>
  					@if($user->status==1)
  					<td>Active</td>
  					@else
  					<td>Inactive</td>
  					@endif
  					@if($user->role_id==1)
  					<td>Project Manager</td>
            @elseif($user->role_id==2)
            <td>Project Member</td>
  					@else
  					<td>Admin</td>
  					@endif
  					@if($user->id != Auth::user()->id)
  					<td>
  						<a class="btn btn-primary btn-sm mr-1" href="{{route('user-edit-information',['id'=>$user->id])}}">Edit</a>
  						<a href="{{route('user-change-status',['id'=>$user->id])}}" class="btn btn-secondary btn-sm mr-1">Change Status</a>
  						<a href="{{route('user-change-role',['id'=>$user->id])}}" class="btn btn-success btn-sm mr-1">Change Role</a>
  						<a href="{{route('user-delete',['id'=>$user->id])}}" class="btn btn-sm btn-danger">Delete</a>
  					</td>
  					@endif
    			</tr>
    			<?php $i++; ?>
    			@endforeach
			</tbody>
		</table>
		
	@endsection
@include('manager.includes.footer')