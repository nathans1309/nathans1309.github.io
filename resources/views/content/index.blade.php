@extends('layouts.master')
@section('title', 'Content Library')

@section('content')

<div class="row">
@foreach ($data as $item)
  <div class="col-sm-6 col-md-3">
    <div class="thumbnail">
      <img class="img-responsive img-rounded" src="http://placehold.it/300x300" alt="...">
      <div class="caption">
        <h3>{{ $item->title}}</h3>
        <p>{{ $item->text }}</p>
        <p><a href="{{ url('content/load/1') }}" class="btn btn-primary" role="button">Post</a> <a href="#" class="btn btn-default" role="button">Schedule</a></p>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
