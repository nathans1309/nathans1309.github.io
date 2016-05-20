<form action="{{ url('twitter/tweet') }}" method="post">
	{!! csrf_field() !!}
      <textarea cols=40 rows=6 name="message" placeholder="type your message"></textarea>
      <button type="submit">Tweet</button>
</form>