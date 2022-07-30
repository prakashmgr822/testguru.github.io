@extends('templates.edit')
@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.15.2/dist/katex.min.css" integrity="sha384-MlJdn/WNKDGXveldHDdyRP1R4CTHr3FeuDNfhsLPYrq2t0UBkUdK2jyTnXPEK1NQ" crossorigin="anonymous">

@endpush
@section('form_content')
    @include('admins.questions.form')
@endsection
@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.1/dist/katex.min.js"
            integrity="sha384-2BKqo+exmr9su6dir+qCw08N2ZKRucY4PrGQPPWU1A7FtlCGjmEGFqXCv5nyM5Ij"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            questionEditor.root.innerHTML = '{!!$item['question']!!}';
            option1Editor.root.innerHTML = '{!!$item['option_1']!!}';
            option2Editor.root.innerHTML = '{!!$item['option_2']!!}';
            option3Editor.root.innerHTML = '{!!$item['option_3']!!}';
            option4Editor.root.innerHTML = '{!!$item['option_4']!!}';
            hintEditor.root.innerHTML = '{!!$item['hint']!!}';
        });

        $('#button_submit').click(
            function (e) {
                var form = $('#form');
                $("#question").val(questionEditor.root.innerHTML);
                $("#option_1").val(option1Editor.root.innerHTML);
                $("#option_2").val(option2Editor.root.innerHTML);
                $("#option_3").val(option3Editor.root.innerHTML);
                $("#option_4").val(option4Editor.root.innerHTML);
                $("#hintBox").val(hintEditor.root.innerHTML);

                if (!form.valid()) {
                    return;
                } else
                    form.submit();
            });
    </script>

    <script>
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike','image'],        // toggled buttons
            ['formula'],
            [{'script': 'sub'}, {'script': 'super'}],
            ['clean']                                         // remove formatting button
        ];
        var questionEditor = new Quill('#questionEditor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Type question here',
            theme: 'snow'
        });

        var option1Editor = new Quill('#option1Editor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Enter option 1 here',
            theme: 'snow'
        });
        var option2Editor = new Quill('#option2Editor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Enter option 2 here',
            theme: 'snow'
        });
        var option3Editor = new Quill('#option3Editor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Enter option 3 here',
            theme: 'snow'
        });
        var option4Editor = new Quill('#option4Editor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Enter option 4 here',
            theme: 'snow'
        });
        var hintEditor = new Quill('#hint', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Enter hint here',
            theme: 'snow'
        });

    </script>
@endpush
