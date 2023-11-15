@extends('frontend.layout.main_layout')

@php
use App\Http\Services\HotelService;

$hotelService = new HotelService;
@endphp

@section('main.layout.content')
    @include('frontend.pages.details.heading')
    @include('frontend.pages.details.image')
    @include('frontend.pages.details.tags')
    <form action="{{ route('hotel.booking.add') }}" method="POST" id="form-booking">
        <div class="flex gap-x-[90px] pb-16">
            @include('frontend.pages.details.info_left')
            @include('frontend.pages.details.info_right')
        </div>
        <div class="info-bottom max-w-[970px] mx-auto pt-16">
            @include('frontend.pages.details.room')
        </div>
    </form>
@endsection

@section('frontend.js')
    <script src="/js/checkout.js"></script>
@endsection

