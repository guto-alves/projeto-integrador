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
        </div>
    </div>

    <div class="container">
        <h3>Conteúdo</h3>
        <div id="content-editor"></div>
    </div>

    <script>
        hljs.configure({
            tabReplace: '    ',
            languages: ['java']
        });
        hljs.highlightAll();

        let editor = new Quill('#content-editor', {
            modules: {
                syntax: true,
                toolbar: false
            },
            readOnly: true,
            theme: 'snow'
        });
        editor.clipboard.dangerouslyPasteHTML(@json($lesson->content));
    </script>
@endsection

