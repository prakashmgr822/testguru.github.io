@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Student Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{$tests}}</h3>
                    <p>Total Online Exams</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe"></i>
                </div>
                <a href="{{route('test.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('css')

@stop

@section('js')

@stop

