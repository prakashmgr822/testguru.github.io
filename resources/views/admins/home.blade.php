@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{$questions}}</h3>
                    <p>Total Questions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <a href="{{route('questions.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$subjects}}</h3>
                    <p>Total Subjects</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{route('subjects.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

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
                <a href="{{route('tests.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('css')

@stop

@section('js')

@stop

