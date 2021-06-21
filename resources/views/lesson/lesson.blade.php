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

            <h3 class="text-center font-weight-bold">{{ $lesson->name }}</h3>
            <p>{{ $lesson->description }}</p>

            @if($editable)
                <div class="text-right"><a class="btn btn-sm btn-light"
                                           href="{{ route('lessons.edit', $lesson->id) }}">Editar Aula</a>
                </div>
            @endif
        </div>
    </div>

    <div class="container mt-4">
        <h5 class="font-weight-bold">Conteúdo</h5>
        <div id="content-editor" class="shadow"></div>

        <h5 class="font-weight-bold mt-5">Comentários ({{ count($lesson->comments) }})</h5>
        <ul id="comments" class="list-group">
            @foreach($lesson->comments as $comment)
                <li class="list-group-item mb-2">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div class="d-flex align-items-baseline">
                            <span class="text-muted mr-1">Autor</span>
                            <h6>{{ $comment->author->name }}</h6>
                        </div>
                        <small>{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i:s') }}</small>
                    </div>
                    <div class="comment-body-editor">{{ $comment->body }}</div>
                </li>
            @endforeach
        </ul>

        <h5 class="font-weight-bold mt-4">Deixe seu comentário</h5>
        <div id="comment-editor"></div>
        <div class="row justify-content-center my-2">
            <button type="button" id="create-comment-button" class="btn btn-primary col-md-6">Comentar
            </button>
        </div>
    </div>

    <script>
        hljs.configure({
            tabReplace: '    ',
            languages: ['java', 'javascript', 'html']
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
                    [{'size': ['small', false, 'large']}], // custom dropdown
                    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                    [{'header': [2, 3, 4, false]}],
                    [{'color': []}, {'background': []}], // dropdown with defaults from theme
                    [{'script': 'sub'}, {'script': 'super'}], // superscript/subscript
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'direction': 'rtl'}], // text direction
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video', 'formula'],
                    ['clean'] // remove formatting button
                ]
            },
            theme: 'snow'
        });

        let comments = @json($lesson->comments);
        comments.forEach(function () {
            $('#comments').append();
        })

        $('.comment-body-editor').each(function () {
            new Quill($(this).get(0), {
                modules: {
                    syntax: true,
                    toolbar: false
                },
                readOnly: true,
                theme: 'snow'
            }).clipboard.dangerouslyPasteHTML($(this).text());
        })

        $('#create-comment-button').click(function () {
            let commentBody = commentEditor.root.innerHTML;

            $.ajax({
                method: 'POST',
                url: "{{ route('comments.store', $lesson->id) }}",
                data: {body: commentBody, _token: '{{csrf_token()}}'}
            }).done(function () {
                location.reload();
            }).fail(function (jqXHR, textStatus) {
                console.log(textStatus);
            });
        });
    </script>
@endsection

