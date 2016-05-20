@extends('layouts.master')
@section('title', 'Scheduled Content')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="list-group">
                @foreach ($data as $item)
                    <li class="list-group-item">
                        <span class="badge">{{$item->time}}</span>
                        {{$item->title}}
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
@endsection