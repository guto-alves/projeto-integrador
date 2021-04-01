@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-primary text-white mb-3">
        <div class="container p-3">
            <h3 class="text-center">{{$course->name}}</h3>
            <p>{{$course->description}}</p>

            <a class="btn btn-light text-right" href="{{ route('lessons.create', [$course->id]) }}">Criar Plano de
                Aula</a>
        </div>
    </div>

    @if(session('errorMessage'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('errorMessage')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('successMessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successMessage') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

@endsection

