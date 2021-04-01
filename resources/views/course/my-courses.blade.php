@extends('layouts.app')

@section('style')
    <style type="text/css">
        .card {
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.01);
        }

        .page-title {
            border-left: 4px solid #3490dc !important;
            font-weight: bold;
            padding-left: 1rem !important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="page-title">Meus Cursos</h3>
            <a class="btn btn-primary" role="button" href="{{route('course.create')}}">Criar novo curso</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2">
            @foreach ($courses as $course)
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$course->name}}</h5>
                            <p class="card-text">{{$course->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
