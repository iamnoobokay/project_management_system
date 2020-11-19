@extends('manager.includes.admin-header')
	@section('content')
		<table class="table table-striped">
		  	<thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Date</th>
			      <th scope="col">Checkin</th>
            <th scope="col">Today's Tasks</th>
            <th scope="col">Tomorrow's Tasks</th>
			      <th scope="col">Checkout</th>
			      <th scope="col">Hours</th>
			    </tr>
		  	</thead>
  			<tbody>
  				<?php $i=1; ?>
  				@foreach($attendances as $attendance)
    			<tr>
					 <th scope="row">{{$i}}</th>
  				  <td>{{$attendance->date}}</td>
  				  <td>{{$attendance->checkin}}</td>
            <td>{{$attendance->work_details}}</td>
            <td>{{$attendance->tomorrow_work}}</td>
            <td>{{$attendance->checkout}}</td>
            <td>{{$attendance->hours}}</td>	
    			</tr>
    			<?php $i++; ?>
    			@endforeach
			</tbody>
		</table>
		
	@endsection
@include('manager.includes.footer')