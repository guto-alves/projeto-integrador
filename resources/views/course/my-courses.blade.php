@extends('layouts.app')

@section('custom-head')
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
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="page-title">Meus Cursos</h3>
            <a class="btn btn-primary font-weight-bold" role="button" href="{{ route('course.create') }}">Criar novo
                Curso</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2">
            @foreach ($courses as $course)
                <div class="col mb-4">
                    <div class="card" onclick="showCourse({{ $course->id }})">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        function showCourse(courseId) {
            location.href = '/course/' + courseId;
        }
    </script>
@endsection
