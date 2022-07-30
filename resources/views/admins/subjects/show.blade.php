@extends('templates.show')
@push('styles')
@endpush
@section('form_content')
    <div class="row my-4">
        <div class="col-md-6">
            <label for=""><span class="show-text">Subject Name:</span></label> {{ $item->name}}<br>
        </div>
        <div class="col-md-6">
            <label for=""><span class="show-text">Grade Name:</span></label> {{ $item->grade->name}}<br>
        </div>

    </div>


@endsection
