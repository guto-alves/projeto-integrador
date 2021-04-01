@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-primary text-white">
        <div class="container p-3">
            <h3 class="text-center">{{$course->name}}</h3>
            <p>{{$course->description}}</p>
        </div>
    </div>
@endsection

