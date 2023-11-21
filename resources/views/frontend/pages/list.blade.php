@extends('frontend.layout.main_layout')

@section('main.layout.content')
    <div class="flex max-lg:px-5 max-lg:flex-col gap-x-10 mt-[120px] lg:px-[60px]">
        @include('frontend.pages.list.filter')
        @yield('frontend.category.list')
    </div>
@endsection
