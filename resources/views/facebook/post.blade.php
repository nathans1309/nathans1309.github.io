<form action="{{ url('fb/post') }}" method="post">
	{!! csrf_field() !!}
      <input type = "text" name="message" placeholder="type your message"/>
      <button type="submit">Post</button>
</form>