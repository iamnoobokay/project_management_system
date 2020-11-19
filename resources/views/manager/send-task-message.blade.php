@extends('manager.includes.header')
	@section('content')
		<form method="post" action="{{route('send-task-mail-manager',['id'=>$task->id])}}" class="center_div">
            <div class="form-group">
                <label for="message">Write a message</label>
                <input type="text" class="form-control" name="message" id="message"	value="">
            </div>

            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
	@endsection
@include('manager.includes.footer')