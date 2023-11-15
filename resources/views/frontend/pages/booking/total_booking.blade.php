@if(count($bookings) > 0)
    <div class="total-booking booking-content active" data-content="total-booking">
        <ul class="flex flex-col my-booking-list gap-y-6">
            @foreach ( $bookings as $booking )
                @php
                    $hotel = $hotelService->getHotel($booking->hotel_id);
                @endphp
                <li class="my-booking-item">
                    <div class="flex items-center mb-8 hotel-info gap-x-5">
                        <div class="hotel-image">
                            <img src="{{ $hotel->image }}" class="w-[146px] h-[114px] rounded-xl" alt="">
                        </div>
                        <div class="hotel-details">
                            <a
                                href="{{route('hotel.details',[
                                    'slug' => Str::slug($hotel->name),
                                    'id' => $hotel->id
                                ])}}"
                            >
                                <strong class="text-xl font-medium">{{ $hotel->name }}</strong>
                            </a>
                            <p class="text-xl text-[#84878B]">
                                {{ $hotelService->getLocationName($hotel->location_id) }},
                                {{ $hotelService->getCountryName($hotel->location_id) }}
                            </p>
                        </div>
                        <span class="ml-auto text-lg font-medium">Booked on {{ $booking->created_at }}</span>
                    </div>
                    <div class="flex items-end justify-between booking-info">
                        <div class="flex flex-col booking-details gap-y-3 text-[#84878B]">
                            <div class="flex items-center justify-between gap-x-8">
                                <span class="font-bold">Booking Code</span>
                                <span class="text-right">{{ $booking->booking_code }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-x-8">
                                <span class="font-bold">Check In</span>
                                <span class="text-right">{{ $checkoutService->getDate($booking->check_in) }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-x-8">
                                <span class="font-bold">Check Out</span>
                                <span class="text-right">{{ $checkoutService->getDate($booking->check_out) }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-x-8">
                                <span class="font-bold">Room Type</span>
                                <span class="text-right">{{ $bookingService->getRoomName($booking->room_id) }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center bookings-action">
                            <span class="text-2xl font-medium">TBH ${{ $booking->total_price }}</span>
                            <span class="pb-3">Payment by {{ $booking->payment }}</span>
                            <a  href="{{route('hotel.details',['slug' => Str::slug($hotel->name),'id' => $hotel->id])}}"
                                class="button-primary px-[90px]"
                            >
                                Book Again
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@else
    No booking previous <a href="{{ route('home') }}">Go to home to select your hotel</a>
@endif
