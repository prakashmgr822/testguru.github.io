@extends('templates.show')
@push('styles')
@endpush
@section('form_content')
    <div class="row my-4">
        <div class="col-md-6">
            <label for=""><span class="show-text">Grade Name:</span></label> {{ $item->name}}<br>
        </div>
        <div class="col-md-6">
            <label for=""><span class="show-text">Email:</span></label> {{ $item->email}}<br>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-6">
            <label for=""><span class="show-text">Phone:</span></label> {{ $item->phone?? '---'}}<br>
        </div>
        <div class="col-md-6">
            <label for=""><span class="show-text">Date of birth:</span></label> {{ $item->dob ?? '---'}}<br>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-6">
            <label for=""><span class="show-text">Grade:</span></label> {{ $item->grade->name ?? '---'}}<br>
        </div>
        <div class="col-md-6">
            <label for=""><span class="show-text">Roll No:</span></label> {{ $item->roll_no ?? '---'}}<br>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-6">
            <label for=""><span class="show-text">Address:</span></label> {{ $item->address ?? '---'}}<br>
        </div>
        <div class="col-md-6">
            <label for=""><span class="show-text">Gender:</span></label> {{ $item->gender ?? '---'}}<br>
        </div>
    </div>
@endsection
