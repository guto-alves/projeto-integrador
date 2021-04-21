@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label for="input-filter">Filtrar</label>
                <input type="text" id="input-filter" class="form-control" placeholder="Pesquise por qualquer coisa ...">

                <hr>
                <div id="totalLessons" class="text-right">{{ count($lessons) }} aulas</div>

                <div class="list-group mt-4">
                    @foreach($lessons as $lesson)
                        <a href="{{ route('lessons.show', $lesson->id) }}"
                           class="list-group-item list-group-item-action mb-3 border">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="font-weight-bold mb-1">{{ $lesson->name }}</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">{{ $lesson->description }}</p>
                            <small class="badge badge-primary">{{ $lesson->course->name }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#input-filter').keyup(function () {
            let filterText = $(this).val();

            let totalLessons = 0;

            $('.list-group-item').each(function () {
                let lessonCardContainer = $(this);
                let lessonCardText = lessonCardContainer.text();

                if (lessonCardText.toUpperCase().indexOf(filterText.toUpperCase()) > -1) {
                    lessonCardContainer.show();
                    totalLessons++;
                } else {
                    lessonCardContainer.hide();
                }
            });

            if (totalLessons > 0) {
                $('#totalLessons').text(`${totalLessons} aulas`);
            } else {
                $('#totalLessons').text('Nenhuma aula encontrada');
            }
        });
    </script>
@endsection
