@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>SuperAdmin Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-blue">
                <div class="inner">
                    <h3>{{$grades}}</h3>
                    <p>Total Grades</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-ol"></i>
                </div>
                <a href="{{route('grades.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <!-- small box -->
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{$admins}}</h3>
                    <p>Total Admins</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{route('admins.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
