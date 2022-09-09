@extends('templates.index')

@section('title', 'Tests')

@section('content_header')
    <h1>Tests</h1>
@stop

@section('ext_css')

@stop

@section('index_content')
    <div class="table-responsive">
        <table class="table" id="data-table">
            <thead>
            <tr class="text-left text-capitalize">
                <th>#id</th>
                <th>Name</th>
                <th>Correct Marks</th>
                <th>Scheduled Date</th>
                <th>Exam Duration</th>
                <th>Created At</th>
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
                ajax: "{{ route('tests.index') }}",
                columns: [
                    {data: 'id', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'correct_marks', name: 'correct_marks'},
                    {data: 'target_date', name: 'target_date'},
                    {data: 'exam_duration', name: 'exam_duration'},
                    {data: 'created_at', name: 'created_at'},
                    // {
                    //     data: 'status', name: 'type', render: function (data, type, full, meta) {
                    //         switch (data) {
                    //             case (0):
                    //                 return `<span class="badge badge-success">Completed</span>`;
                    //                 break;
                    //             case (1):
                    //                 return `<span class="badge badge-danger">Pending</span>`;
                    //                 break;
                    //             default:
                    //                 return `<span class="badge badge-success">Pending</span>`;
                    //         }
                    //     }
                    // },
                    {data: 'action', name: 'action'},
                ],
            });
        });
        setTimeout(function () {
            $('.alert').hide();
        }, 3000);
    </script>
@endpush
