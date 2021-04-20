@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label for="input-filter">Filtrar</label>
                <input type="text" id="input-filter" class="form-control" placeholder="Pesquise por qualquer coisa ...">

                <hr>
                <div class="text-right">{{ count($lessons) }} aulas</div>

                <div class="list-group mt-4">
                    @forelse($lessons as $lesson)
                        <a href="{{ route('lessons.show', $lesson->id) }}"
                           class="list-group-item list-group-item-action mb-3 border">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="font-weight-bold mb-1">{{ $lesson->name }}</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">{{ $lesson->description }}</p>
                            <small class="badge badge-primary">{{ $lesson->course->name }}</small>
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
        </div>
    </div>

    <script type="text/javascript">
        $('#input-filter').keyup(function () {
            let filterText = $(this).val();

            $('.list-group-item').each(function () {
                let lessonCardContainer = $(this);
                let lessonCardText = lessonCardContainer.text();

                if (lessonCardText.toUpperCase().indexOf(filterText.toUpperCase()) > -1) {
                    lessonCardContainer.show();
                } else {
                    lessonCardContainer.hide();
                }
            });
        });
    </script>
@endsection
