@extends('templates.index')

@section('title', 'Questions')

@section('content_header')
    <h1>Questions</h1>
@stop

@section('ext_css')

@stop

@section('index_content')
    <div class="table-responsive">
        <table class="table" id="data-table">
            <thead>
            <tr class="text-left text-capitalize">
                <th>#id</th>
                <th>Question</th>
                <th>grade</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Answer</th>
                <th>action</th>
            </tr>
            </thead>

        </table>
    </div>
@stop

@push('scripts')
    <script>
        $(function () {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('questions.index') }}",
                columns: [
                    {data: 'id', name: 'DT_RowIndex'},
                    {data: 'question', name: 'question'},
                    {data: 'grade_id', name: 'grade_id'},
                    {data: 'option_1', name: 'option_1'},
                    {data: 'option_2', name: 'option_2'},
                    {data: 'option_3', name: 'option_3'},
                    {data: 'option_4', name: 'option_4'},
                    {data: 'answer', name: 'answer'},
                    {data: 'action', name: 'action'},
                ],
            });
        });
        setTimeout(function(){
            $('.alert').hide();
        },3000);
    </script>
@endpush
