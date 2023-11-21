@extends('frontend.layout.main_layout')

@section('main.layout.content')
    <div class="flex gap-x-10 mt-[120px]">
        @include('frontend.pages.list.filter')
        @yield('frontend.category.list')
    </div>
@endsection
