<!DOCTYPE html>
<html>
<head>
	<title>Four Tuples Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="height: 100vh">
		@if(session()->has('message'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
		  		<strong>{{session()->get('message')}}</strong>
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    		<span aria-hidden="true">&times;</span>
		      	</button>
			</div>
		@endif
		<div class="col-md-6 m-auto">
			<h2 style="margin-bottom: 40px;margin-top: 40px">Login To Task Manager</h2>
			<form method="POST" action="{{route('login-verification')}}">
				  	<div class="form-group">
				    	<label for="email">Email address</label>
				    	<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
				    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				  	</div>
				  	<div class="form-group">
				    	<label for="password">Password</label>
				    	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				  	</div>
				  	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				  	<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>