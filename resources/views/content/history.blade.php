@extends('layouts.master')
@section('title', 'Content History')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="list-group">
                @foreach ($data as $item)
                  <a href="#" class="list-group-item disabled">
                    {{$item->title}}
                  </a>
                @endforeach
            </ul>

        </div>
    </div>
@endsection
