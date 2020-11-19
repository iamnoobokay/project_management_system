@extends('manager.includes.admin-header')
	@section('content')
	<script type="text/javascript">
		checkDate();
		function checkDate(){
		    $.ajax({
		            url: "check-birthday",
		            type: "GET",
		            success: function(dataResult){
		                dataResult.forEach(myFunction);           
		            }
		    });
		}

		function myFunction(name){
		    alert("Today is "+name+"'s birthday.");
		}
	</script>
		<div class="container">
			@if(session()->has('checkin-message'))
	            <div class="alert alert-success alert-dismissible fade show" role="alert">
	                <strong>{{session()->get('checkin-message')}}</strong>
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
        	@endif
			<div class="card">
				<div class="card-header">
					<h4>Welcome {{Auth::user()->name}}</h4>
				</div>
				<div class="card-body">
					<a href="{{route('checkin')}}" class="btn btn-primary mb-2">Checkin</a>

					<form method="POST" action="{{route('checkout')}}">
						<input type="text" class="form-control mb-2" name="tasks-completed" placeholder="What did you do today??" required>
						<input type="text" name="tomorrow-task" class="form-control mb-2" placeholder="What will you do tomorrow??" required>
						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            			<button type="submit" class="btn btn-danger">Checkout</button>
					</form>
				</div>
			</div>
		</div>
	@endsection
@include('manager.includes.footer')