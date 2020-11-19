<!DOCTYPE html>
<html>
<head>
	<title>Welcome {{Auth::user()->name}}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
</head>
<body>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3">
				<div class="col-md-12 sidebar">
					<h6>Welcome {{Auth::user()->name}}</h6>
					<ul class="nav flex-column">
						<li class="nav-item">
		    					<a class="btn" href="{{route('checkin-checkout-view')}}">Checkin/Checkout</a>
		  				</li>

		  				<li class="nav-item">
		    				<div class="dropdown">
	  							<button type="button" class="btn" data-toggle="dropdown">
	    						Manage Tasks
	  							</button>
							  	<div class="dropdown-menu">
							  		<a class="nav-link" href="{{route('tasks-by-projects')}}">Create Tasks</a>
							  		<a href="{{route('get-by-users')}}" class="nav-link">View Tasks By Users</a>
							  		<a href="{{route('project-get-task')}}" class="nav-link">View Tasks By Projects</a>
							  	</div>
							</div>
		  				</li>

		  				<li class="nav-item">
		    				<div class="dropdown">
	  							<button type="button" class="btn" data-toggle="dropdown">
	    						View Assigned Tasks
	  							</button>
							  	<div class="dropdown-menu">
							  		<a class="nav-link" href="{{route('manager-assigned-tasks-project')}}">Tasks By Projects</a>
							  		<a href="{{route('manager-tasks-by-deadline')}}" class="nav-link">Tasks By Deadline</a>
							  	</div>
							</div>
		  				</li>

		  				<li class="nav-item">
		    					<a class="btn" href="{{route('logout')}}">Logout</a>
		  				</li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				@yield('content')
			</div>
		</div>
	</div>