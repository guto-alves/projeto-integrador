@extends('layouts.app')

@section('custom-head')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.1/styles/monokai-sublime.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.1/highlight.min.js"></script>

    <!-- KaTeX - Math elements -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.13.0/dist/katex.min.css"
          integrity="sha384-t5CR+zwDAROtph0PXGte6ia8heboACF9R5l/DiY+WZ3P2lxNgvJkQk5n7GPvLMYw" crossorigin="anonymous">
    <!-- The loading of KaTeX is deferred to speed up page rendering -->
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.13.0/dist/katex.min.js"
            integrity="sha384-FaFLTlohFghEIZkw6VGwmf9ISTubWAVYW8tG8+w2LAIftJEULZABrF9PPFv+tVkH"
            crossorigin="anonymous"></script>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection

@section('content')
    <div class="container-fluid bg-primary text-white mb-3">
        <div class="container p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Meus Cursos</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('course.show', [$lesson->course->id]) }}">{{ $lesson->course->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $lesson->name }}</li>
                </ol>
            </nav>

            <h3 class="text-center">{{ $lesson->name }}</h3>
            <p>{{ $lesson->description }}</p>

            <div class="text-right"><a class="btn btn-sm btn-light"
                                       href="{{ route('lessons.edit', $lesson->id) }}">Editar Aula</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="font-weight-bold">Conteúdo</h3>
        <div id="content-editor"></div>

        <h4 class="font-weight-bold mt-3">Comentários ({{ count($lesson->comments) }})</h4>
        <hr>

        <h4 class="font-weight-bold mt-4">Deixe seu comentário</h4>
        <div id="comment-editor"></div>
        <div class="text-center">
            <button type="button" id="create-comment-button" class="btn btn-primary mt-3">Comentar
            </button>
        </div>
    </div>

    <script>
        hljs.configure({
            tabReplace: '    ',
            languages: ['java']
        });
        hljs.highlightAll();

        let contentEditor = new Quill('#content-editor', {
            modules: {
                syntax: true,
                toolbar: false
            },
            readOnly: true,
            theme: 'snow'
        });
        contentEditor.clipboard.dangerouslyPasteHTML(@json($lesson->content));

        let commentEditor = new Quill('#comment-editor', {
            modules: {
                syntax: true,
                toolbar: [
                    [{'font': []}],
                    [{'size': ['small', false, 'large', 'huge']}], // custom dropdown
                    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                    [{'header': 1}, {'header': 2}], // custom button values
                    [{'header': [1, 2, 3, 4, 5, 6, false]}],
                    [{'color': []}, {'background': []}], // dropdown with defaults from theme
                    [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                    [{'script': 'sub'}, {'script': 'super'}], // superscript/subscript
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'indent': '-1'}, {'indent': '+1'}], // outdent/indent
                    [{'direction': 'rtl'}], // text direction
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video', 'formula'],
                    ['clean'] // remove formatting button
                ]
            },
            theme: 'snow'
        });

        $('#create-comment-button').click(function () {
            let commentBody = commentEditor.root.innerHTML;

            // let lessonId = @json($lesson->id);

            $.ajax({
                method: 'POST',
                url: "{{ route('comments.store', $lesson->id) }}",
                data: {body: commentBody, _token: '{{csrf_token()}}'}
            }).done(function (data) {
                console.log('success!', data);
            }).fail(function (jqXHR, textStatus) {
                console.log(textStatus);
            });
        });
    </script>
@endsection

