@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Novo Curso') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('course.store')}}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-text">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="Nome do curso">
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-text">Descrição</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Criar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
