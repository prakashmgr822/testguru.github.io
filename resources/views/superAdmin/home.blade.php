@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>SuperAdmin Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$students}}</h3>
                <p>Total Students</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('students.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{$admins}}</h3>
                    <p>Total Admins</p>
                </div>
                <div class="icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <a href="{{route('admins.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('css')

@stop

@section('js')

@stop

