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
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Meus Cursos</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('course.show', [$lesson->course->id]) }}">
                                {{ $lesson->course->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Atualizar Aula</li>
                    </ol>
                </nav>

                <div class="card">
                    <div
                        class="card-header text-center font-weight-bold">{{'Atualizar - ' . $lesson->name }}</div>
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

                        <form action="{{ route('lessons.update', [$lesson->id]) }}" method="post">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="id" name="id" value="{{ $lesson->id }}">

                            <div class="mb-3">
                                <label for="name" class="form-text">Nome</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="Nome da aula" value="{{ $lesson->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-text">Descrição</label>
                                <textarea name="description" id="description" class="form-control" rows="2"
                                          placeholder="Curta descrição..."
                                          maxlength="500">{{ $lesson->description }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-text">Conteúdo</label>
                                <div id="content-editor" style="height: 350px;"></div>
                                <input type="hidden" id="content" name="content">
                            </div>

                            <div class="row justify-content-center mx-3">
                                <button type="submit" class="btn btn-primary col-md-6">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        hljs.configure({
            tabReplace: '    ',
            languages: ['java']
        });
        hljs.highlightAll();

        let editor = new Quill('#content-editor', {
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
                ],
                history: {
                    delay: 2000,
                    maxStack: 500,
                    userOnly: true
                }
            },
            theme: 'snow'
        });
        editor.clipboard.dangerouslyPasteHTML(@json($lesson->content));

        $('form').submit(function () {
            $('#content').val(editor.root.innerHTML);
        });
    </script>
@endsection
