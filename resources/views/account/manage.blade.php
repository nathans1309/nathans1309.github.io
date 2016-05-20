@extends('layouts.master')
@section('title', 'Manage Account')

@section('content')
<dl class="dl-horizontal">
  <dt>{{Auth::user()->name}}</dt>
  <dd>{{Auth::user()->email}} </dd>
  <dt>Profiles</dt>
  <dd> 
  @if(isset($facebook_access_token) && isset($page_id))
  	<p>Facebook is already active!</p>
  @else
  	<a href="{{url($fbLoginUrl)}}">Add Facebook</a>
  @endif

  </dd>
  <dd>
  	@if(isset($twitter_access_token))
  	<p>Twitter is already active</p>
	@else
  	<a href="{{url($twitterLoginUrl)}}">Add Twitter</a>
  	@endif
</dd>
</dl>

@endsection