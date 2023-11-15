@extends('frontend.layout.main_layout')

@section('main.layout.content')
    @include('frontend.pages.home.hotel')
    @include('frontend.pages.home.flight')
    @include('frontend.pages.home.car')
@endsection
