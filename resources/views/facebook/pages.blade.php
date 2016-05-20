<form action="{{ url('fb/save_pages') }}" method="post">
	{!! csrf_field() !!}
	@foreach($data as $key => $value)
		<input type="radio" name="page_id" value="{{$value->id}}" >{{$value->name}} <br>
	@endforeach
	<button type="submit">Continue</button>
</form>