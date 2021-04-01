@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Meus Cursos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Criar novo Curso</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Novo Curso') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{route('course.store')}}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-text">Nome</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="Nome do curso" maxlength="100">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-text">Descrição</label>
                                <textarea name="description" id="description" class="form-control" rows="3"
                                          maxlength="255"></textarea>
                            </div>

                            <div class="row justify-content-center mx-3">
                                <button type="submit" class="btn btn-primary col-md-6">Criar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
