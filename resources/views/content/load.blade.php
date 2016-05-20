@extends('layouts.master')
@section('title', 'Post')

@section('content')

<form action="{{ url('content/socialBlast') }}" method="post">
{!! csrf_field() !!}
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" value = "{{$title}}" name="title" placeholder="Title">
  </div>
  <div class="form-group">
    <textarea name="text" id="" cols="100" rows="10">
    	{{$text}}
    </textarea>
  </div>
  <div class="form-group">
    <img src="{{$img}}" alt="">
    <input type="file" name="image">
    <p class="help-block">upload image</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="postToFB"> Post to Facebook
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="postToTwitter"> Post to Twitter
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

@endsection