@extends('frontend.layout.main_layout')

@php
use App\Http\Services\CheckoutService;
use App\Http\Services\HotelService;
use App\Http\Services\BookingService;

$checkoutService = new CheckoutService;
$hotelService = new HotelService;
$bookingService = new BookingService;
@endphp

@section('main.layout.content')
    <div class="my-bookings max-w-[1200px] px-[15px] mx-auto mt-10">
        <div class="section-heading mb-9">
            <h1 class="section-title">Bookings</h1>
        </div>
        <ul class="bookings-tabs-nav flex items-center gap-x-[123px] pb-5 border-b-2 border-[#F4F5F6] mb-7">
            <li class="text-lg font-medium tab-item active" data-content="total-booking">
                Total bookings ({{ count($bookings) }})
            </li>
            <li class="text-lg font-medium tab-item" data-content="cancel-booking">
                Cancelled ({{ count($bookingsCancel) }})
            </li>
        </ul>
        <div class="bookings-main">
            @include('frontend.pages.booking.total_booking')
            @include('frontend.pages.booking.cancel')
        </div>
    </div>
@endsection

