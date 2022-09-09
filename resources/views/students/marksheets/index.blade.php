@extends('templates.index')

@section('title', 'Marksheets')

@section('content_header')
    <h1>Marksheets</h1>
@stop

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
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
                <th>test</th>
                <th>total questions</th>
                <th>total score</th>
                <th>obtained score</th>
                <th>date</th>
            </tr>
            </thead>

        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
{{--    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/sl-1.3.1/datatables.min.js"></script>--}}

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
                        url:  "{{ route('marksheet.index') }}",
                        data: {
                            test_id: test_id,
                            dropdown_id: dropdown_test
                        }
                    },
                    columns: [
                        {data: 'id', name: 'DT_RowIndex'},
                        {data: 'test_id', name: 'test_id'},
                        {data: 'total_questions', name: 'total_questions'},
                        {data: 'total_score', name: 'total_score'},
                        {data: 'obtained_score', name: 'obtained_score'},
                        {data: 'created_at', name: 'created_at'},
                    ],
                });
            }
        });


    </script>
@endpush
