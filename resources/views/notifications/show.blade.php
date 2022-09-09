@extends('adminlte::page')
@section('css')
    @stack('styles')
@stop

@section('title', 'notification')
@section('content_header')
<h1>Notification</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col">
                    <!-- general form elements -->
                    <div class="card">


                        <div class="card-body">
                            <div class="row my-4 ">
                                <div class="col-md-12 text-center">
                                    <label for=""><span class="show-text">Test Name:</span></label> {{$test->name}}<br>
                                </div>
                            </div>

                            <div class="row my-4 ">
                                <div class="col-md-12 text-center">
                                    <label for=""><span class="show-text">Duration:</span></label> {{$test->exam_duration. ' (minutes)'}}<br>
                                </div>
                            </div>

                            <div class="row my-4 ">
                                <div class="col-md-12 text-center">
                                    <label for=""><span class="show-text">Test Date:</span></label> {{$test->target_date}}<br>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="javascript:history.back();" class="btn btn-default float-right">Cancel</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('js')
    @stack('scripts')
    <script>
        jQuery(document).ready(function () {
            $('#form input').attr('readonly', true);
            $('#form select').attr('disabled', true);
        });
    </script>
@stop



