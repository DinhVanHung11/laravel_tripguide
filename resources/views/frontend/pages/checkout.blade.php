@extends('frontend.layout.main_layout')

@php
use App\Http\Services\CheckoutService;
use App\Http\Services\HotelService;

$checkoutService = new CheckoutService;
$hotelService = new HotelService;

$booking = session()->get('bookings');
$user = auth()->user();
$hotel = $hotelService->getHotel($booking->hotel_id);
@endphp

@section('main.layout.content')
    <div class="max-w-[1170px] mx-auto mt-10 flex gap-x-[35px]">
        <form class="book-payment w-[62%]">
            <div class="book-info w-[70%] mb-10">
                <h1 class="text-[40px] font-bold pb-6 border-b-2 border-[#eee] mb-10">Confirm your Book</h1>
                <div class="pr-6 mb-7 tour-info">
                    <h3 class="text-[34px] font-bold mb-7">Your Tour</h3>
                    <div class="flex flex-col py-2 px-5 bg-[#f4f4f6] rounded-xl mb-5">
                        <label for="">Date</label>
                        <span class="text-[#84878B] font-medium">
                            {{ $checkoutService->getAllDate($booking->check_in, $booking->check_out) }}
                        </span>
                    </div>
                    <div class="flex flex-col py-2 px-5 bg-[#f4f4f6] rounded-xl">
                        <label for="">Traveller</label>
                        <span class="text-[#84878B] font-medium">
                            {{ $checkoutService->getTotalGuest($booking->guest) }} Passenger
                        </span>
                    </div>
                </div>
                <div class="pr-6 user-info">
                    <h3 class="text-[34px] font-bold mb-7">Your Contact</h3>
                    <div class="flex flex-col py-2 px-5 bg-[#f4f4f6] rounded-xl mb-5">
                        <label for="">Email Address</label>
                        <input type="text" placeholder="Enter your address" class="px-0 bg-transparent text-[#84878B]" name="email" value="{{ $user->email ?? ''}}">
                    </div>
                    <div class="flex flex-col py-2 px-5 bg-[#f4f4f6] rounded-xl">
                        <label for="">Phone Number</label>
                        <input type="text" placeholder="Enter your phone" class="px-0 bg-transparent text-[#84878B]" name="phone" value="{{ $user->phone ?? ''}}">
                    </div>
                </div>
            </div>
            <div class="mb-8 payment-method">
                <h3 class="text-[34px] font-bold mb-7">Payment Mothods</h3>
                <ul class="flex mb-10 gap-x-3 pb-7">
                    <div class="p-3 bg-white rounded-md cursor-pointer payment-method-item active"
                        data-url="{{ route('hotel.booking.crash.delivery') }}"
                    >
                        <img src="{{ asset('images/icon-cash-delivery.jpg') }}" class="max-h-7" alt="">
                    </div>
                    <div class="p-3 bg-white rounded-md cursor-pointer payment-method-item"
                        data-url="{{ route('hotel.booking.vnpay') }}"
                    >
                        <img src="{{ asset('images/icon-vnpay.png') }}" class="max-h-7" alt="">
                    </div>
                    <div class="p-3 bg-white rounded-md cursor-pointer payment-method-item"
                        {{-- data-url="{{ route('hotel.booking.vnpay') }}" --}}
                    >
                        <img src="{{ asset('images/icon-paypal.svg') }}" class="max-h-7" alt="">
                    </div>
                </ul>
            </div>
            <button class="px-5 button-primary rounded-3xl">Confirm and reserve</button>
            <input type="hidden" name="price" value="{{ $booking->price }}">
            @csrf
        </form>
        <div class="book-summary w-[38%]">
            <div class="py-10 bg-white px-9 rounded-2xl border-2 border-[#E7ECF3]">
                <p class="mb-4 text-lg font-medium">{{ $hotel->name }}</p>
                <div class="flex items-center mb-4 text-sm font-medium gap-x-2">
                    <img src="{{ asset('images/icon-star.svg') }}" alt="">
                    <span>{{ $hotel->rating }}</span>
                    <span class="text-[#84878B]">(122 reviews)</span>
                </div>
                <div class="mb-6 hotel-image">
                    <img src="{{ $hotel->image }}" class="max-h-[196px] rounded-2xl w-full" alt="">
                </div>
                <div class="flex mb-5 font-medium">
                    <div class="flex flex-col w-1/2">
                        <span class="text-sm  text-[#B1B5C3]">Check In</span>
                        <span class="text-[#84878B]">{{ $checkoutService->getDate($booking->check_in) }}</span>
                    </div>
                    <div class="flex flex-col w-1/2 border-l-2 border-[#F4F5F6] pl-3">
                        <span class="text-sm text-[#B1B5C3]">Check Out</span>
                        <span class="text-[#84878B]">{{ $checkoutService->getDate($booking->check_out) }}</span>
                    </div>
                </div>
                <div class="flex flex-col mb-8">
                    <span class="text-sm  text-[#B1B5C3]">Guest</span>
                    <span class="text-[#84878B]">
                        {{ $checkoutService->getStringGuest($booking->guest) }}
                    </span>
                </div>
                <p class="text-[26px] font-medium mb-8">Booked details</p>
                <div class="flex flex-col px-3 mb-3 font-medium gap-y-5">
                    <div class="flex justify-between">
                        <span class="text-[#84878B]">
                            ${{ $checkoutService->getPricePerNightOrigin() }} + {{ $checkoutService->getNumberDay() }} Nights
                        </span>
                        <span>${{ $checkoutService->getPricePerNightOrigin()*$checkoutService->getNumberDay() }}</span>
                    </div>
                    @if ($checkoutService->getDiscountPercent() != 0)
                        <div class="flex justify-between">
                            <span class="text-[#84878B]">
                                Discount {{ $checkoutService->getDiscountPercent() }}%
                            </span>
                            <span>${{
                                $checkoutService->getPricePerNightOrigin()*$checkoutService->getNumberDay() - $checkoutService->getDiscountPrice()*$checkoutService->getNumberDay()
                            }}</span>
                        </div>
                    @endif
                    @if ($checkoutService->getExFeaturesPrice() != 0)
                        <div class="flex justify-between">
                            <span class="text-[#84878B]">
                                Total Services Fee
                            </span>
                            <span>${{ $checkoutService->getExFeaturesPrice() }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex justify-between font-medium py-2 px-3 bg-[#F4F5F6] rounded-md">
                    <span>Total</span>
                    <span>${{ $booking->price }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('frontend.js')
    <script src="/js/checkout.js"></script>
@endsection

