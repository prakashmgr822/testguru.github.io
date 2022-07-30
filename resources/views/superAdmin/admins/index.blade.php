@extends('templates.index')

@section('title', 'Admin')

@section('content_header')
    <h1>Admin</h1>
@stop

@section('ext_css')

@stop

@section('index_content')
    <div class="table-responsive">
        <table class="table" id="data-table">
            <thead>
            <tr class="text-left text-capitalize">
                <th>#id</th>
                <th>Email</th>
                <th>School</th>
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
                ajax: "{{ route('admins.index') }}",
                columns: [
                    {data: 'id', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action'},
                ],
            });
        });
        setTimeout(function(){
            $('.alert').hide();
        },3000);
    </script>
@endpush
