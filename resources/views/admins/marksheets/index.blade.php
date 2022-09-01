@extends('templates.index')

@section('title', 'Marksheets')

@section('content_header')
    <h1>Marksheets</h1>
@stop

@push('styles')

@endpush

@section('index_content')
    <input type="hidden" id="test_id" value="{{$id}}">
    <select name="test" id="dropdown_test" class="form-control" style="width: 175px!important;">
        <option value="{{null}}" selected>--Choose a test--</option>
        @foreach($tests as $test)
            <option value="{{$test->id}}">{{$test->name}}</option>
        @endforeach
    </select>
    <br>
    <div class="table-responsive">
        <table class="table table-striped" id="data-table">
            <thead>
            <tr class="text-left text-capitalize">
                <th>id</th>
                <th>test id</th>
                <th>name</th>
                <th>phone</th>
                <th>level</th>
                <th>college name</th>
                <th>address</th>
                <th>correct questions</th>
                <th>incorrect questions</th>
                <th>skipped questions</th>
                <th>total questions</th>
                <th>total score</th>
                <th>obtained score</th>
            </tr>
            </thead>

        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            var test_id = $('#test_id').val();
            var dropdown_test = null;
            dataTable();
            $('#dropdown_test').change(function () {
                dropdown_test =  $('#dropdown_test').val();
                dataTable();
            })

            function dataTable() {
                var table = $('#data-table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    lengthMenu: [[99, -1], [999, "All"]], columnDefs: [
                        {orderable: false, targets: 0}
                    ], processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax:{
                        url:  "{{ route('marksheets.index') }}",
                        data: {
                            test_id: test_id,
                            dropdown_id: dropdown_test
                        }
                    },
                    columns: [
                        {data: 'id', name: 'DT_RowIndex'},
                        {data: 'test_id', name: 'test_id'},
                        {data: 'name', name: 'name'},
                        {data: 'phone', name: 'phone'},
                        {data: 'level', name: 'level'},
                        {data: 'college_name', name: 'college_name'},
                        {data: 'address', name: 'address'},
                        {data: 'total_correct_questions', name: 'total_correct_questions'},
                        {data: 'total_incorrect_questions', name: 'total_incorrect_questions'},
                        {data: 'total_skipped_questions', name: 'total_skipped_questions'},
                        {data: 'total_questions', name: 'total_questions'},
                        {data: 'total_score', name: 'total_score'},
                        {data: 'obtained_score', name: 'obtained_score'},
                    ],
                });
            }
        });


    </script>
@endpush
