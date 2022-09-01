@extends('templates.edit')
@push('styles')
@endpush

@section('form_content')
    @include('admins.tests.form')
@endsection
@section('add_content')
    @include('admins.tests.addContents')
@endsection
@section('form_content1')
    @include('admins.tests.questionLists')
@endsection
@push('scripts')
@endpush

