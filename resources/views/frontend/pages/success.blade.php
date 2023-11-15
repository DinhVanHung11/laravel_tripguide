@extends('frontend.layout.main_layout')

@php
use App\Http\Services\CheckoutService;
use App\Http\Services\HotelService;

$checkoutService = new CheckoutService;
$hotelService = new HotelService;

$hotel = $hotelService->getHotel($booking->hotel_id);
@endphp

@section('main.layout.content')
    <div class="max-w-[1170px] mx-auto mt-10">
        <div class="section-heading pb-6 mb-6 border-b border-[#E7ECF3] w-[70%]">
            <h3 class="mb-4 text-2xl font-bold">Congratulations!</h3>
            <h1 class="section-title">Your trip has been booked!</h1>
        </div>
        <h2 class="text-[34px] font-bold mb-6">{{ $hotel->name }}</h2>
        <div class="flex items-center gap-x-[116px]">
            <div class="flex-1 flex-shrink-0 booking-info">
                <div class="flex gap-x-2 pb-6 mb-6 border-b border-[#F1F2F4]">
                    <img src="{{ asset('images/icon-star.svg') }}" alt="">
                    <span>{{ $hotel->rating }}</span>
                    <span>(122 reviews)</span>
                </div>
                <div class="flex flex-col py-2 px-5 bg-[#f4f4f6] rounded-xl mb-4">
                    <label for="" class="text-sm font-medium">Date</label>
                    <span class="text-[#84878B] font-medium">
                        {{ $checkoutService->getAllDate($booking->check_in, $booking->check_out) }}
                    </span>
                </div>
                <div class="flex flex-col py-2 px-5 bg-[#f4f4f6] rounded-xl mb-7">
                    <label for="" class="text-sm font-medium">Traveller</label>
                    <span class="text-[#84878B] font-medium">
                        {{ $booking->adults + $booking->children + $booking->infants }} Passenger
                    </span>
                </div>
                <div class="p-5 rounded-2xl mb-7 bg-[#F4F4F6] border border-[#F0EFEF]">
                    <p class="text-[28px] font-bold mb-6">Reserve details</p>
                    <div class="flex flex-col gap-y-5">
                        <div class="flex items-center justify-between font-medium">
                            <div class="flex items-center text-[#777E90] gap-x-2">
                                <img src="{{ asset('images/icon-booking-code.svg') }}" alt="">
                                <span class="">Booking code</span>
                            </div>
                            <span>{{ $booking->booking_code }}</span>
                        </div>
                        <div class="flex items-center justify-between font-medium">
                            <div class="flex items-center text-[#777E90] gap-x-2">
                                <img src="{{ asset('images/icon-calendar-small.svg') }}" alt="">
                                <span class="">Date</span>
                            </div>
                            <span>{{ $booking->check_out }}</span>
                        </div>
                        <div class="flex items-center justify-between font-medium">
                            <div class="flex items-center text-[#777E90] gap-x-2">
                                <img src="{{ asset('images/icon-total.svg') }}" alt="">
                                <span class="">Total</span>
                            </div>
                            <span>${{ $booking->total_price }}</span>
                        </div>
                        <div class="flex items-center justify-between font-medium">
                            <div class="flex items-center text-[#777E90] gap-x-2">
                                <img src="{{ asset('images/icon-payment.svg') }}" alt="">
                                <span class="">Payment method</span>
                            </div>
                            <span>{{ ucfirst($booking->payment) }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="px-5 button-primary rounded-3xl">Go To Your Home</a>
            </div>
            <div class="booking-image w-[58%] flex-shrink-0 ml-auto">
                <img src="{{ $hotel->image }}" class="h-[418px] rounded-2xl" alt="">
            </div>
        </div>
    </div>
@endsection

