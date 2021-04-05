@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-primary text-white mb-3">
        <div class="container p-3">
            <h3 class="text-center">{{$course->name}}</h3>
            <p>{{$course->description}}</p>

            <a class="btn btn-light text-right text-center"
               href="{{ route('lessons.create', [$course->id]) }}">
                Criar Plano de Aula
            </a>
        </div>
    </div>

    <div class="container">
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

        <div class="list-group mt-4">
            @forelse($course->lessons as $lesson)
                <a href="#" class="list-group-item list-group-item-action mb-3 border">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="font-weight-bold mb-1">{{ $lesson->name }}</h5>
                        <small>3 days ago</small>
                    </div>
                    <p class="mb-1">{{ $lesson->description }}</p>
                    <small>And some small print.</small>
                </a>
            @empty
                <span>
                    Este Curso não tem nenhum Plano de Aula ainda.
                    <a class="text-decoration-none ml-1"
                       href="{{ route('lessons.create', [$course->id]) }}">Crie um agora mesmo!</a>
                </span>
            @endforelse
        </div>
    </div>

@endsection

