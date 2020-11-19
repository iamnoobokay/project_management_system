@extends('manager.includes.admin-header')
	@section('content')
		<form method="post" action="{{route('attendance-individual-show')}}" style="margin-top: 10px">
      <input type="date" name="date" class="form-control mb-2" required> 
      <button type="submit" class="btn btn-primary">Submit</button>
      <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </form>
    @if(count($attendances))
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
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
            <td>{{$attendance->user->name}}</td>
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
    @endif
	@endsection
@include('manager.includes.footer')