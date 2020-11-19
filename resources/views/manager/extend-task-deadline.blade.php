@extends('manager.includes.header')
	@section('content')
		@if(session()->has('task-message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session()->get('task-message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    	@endif
		<form method="post" action="{{route('new-deadline',['id'=>$tasks->id])}}" class="center_div">
            <div class="form-group">
                <label for="deadline">Extend Deadline</label>
                <input type="date" class="form-control" name="deadline" id="deadline"	value="{{$tasks->deadline}}">
            </div>

            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
	@endsection
@include('manager.includes.footer')