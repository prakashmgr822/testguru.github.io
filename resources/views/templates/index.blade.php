@extends('adminlte::page')


@section('title', $title)

@section('content_header')
    <h1>{{$title}} List</h1>
@stop

@section('css')
    @stack('styles')
@stop

@section('js')
    <script>
        $(document).ready(function () {
            var btnBulkDelete = $("#btn-bulk-delete");

            btnBulkDelete.on('click', function () {
                let checkboxes = $("[name='selections[]']")
                var deletable = [];
                checkboxes.each(function () {
                    if (this.checked) deletable.push(this.value);
                });
                if (deletable.length == 0) {
                    alert("Please select the items to delete.")
                } else {
                    $("#bulk-delete-ids").val(deletable)
                    var route = '{{route('bulkDelete',"bulk")}}';
                    route = route.replace("bulk", deletable);
                    $("#bulk-delete-form").attr('action', route)
                    $("#bulk-delete-form").submit()
                }
            })
        })
    </script>
    @stack('scripts')
@stop


@section('content')
    <form id="bulk-delete-form" method="POST">
        @csrf
        @method('DELETE')
        <input id="bulk-delete-ids" name="id" type="hidden">
    </form>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                            <div class="float-right">
                                @if(!isset($hideCreate))

                                    @if(isset($app_name))
                                        <a href="{{isset($customCreateRoute)?$customCreateRoute:route($route.'create',['app_name'=>$app_name])}}"
                                           class="btn btn-primary float-right">
                                            <i class="fa fa-plus"></i>
                                            <span class="kt-hidden-mobile">Add new</span>
                                        </a>
                                    @else
                                        <a href="{{isset($customCreateRoute)?$customCreateRoute:route($route.'create')}}"
                                           class="btn btn-primary float-right">
                                            <i class="fa fa-plus"></i>
                                            <span class="kt-hidden-mobile">Add new</span>
                                        </a>

                                    @endif
                                @endif

                                @if(isset($showDelete))
                                    <a id="btn-bulk-delete" class="btn btn-danger float-right mr-2">
                                        <i class="fa fa-trash-alt"></i>
                                        <span>Delete Selected</span>
                                    </a>
                                @endif
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @yield('index_content')
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
