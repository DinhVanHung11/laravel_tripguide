@php
use App\Http\Services\HotelService;

$hotelService = new HotelService;
$hotels = $hotelService->getRandomLimit(6);
@endphp

<section class="py-16 mb-16 row-full-width trending md:px-9 bg-[#F5F5F5]">
    <div class="row-inner-content">
        <div class="md:px-9">
            <div class="mb-8 text-center section-heading">
                <h2 class="section-title title-theme">Trending cites</h2>
                <p class="section-desc">
                    The most searched for cities on TripGuide
                </p>
            </div>
            <div class="section-content">
                <div class="block section-block block-trending">
                    @if (!is_null($hotels) && count($hotels) > 0)
                        <ul class="trending-list gap-x-[30px] grid grid-cols-2 gap-y-9 max-sm:grid-cols-1 max-sm:gap-y-7">
                            @foreach ( $hotels as $hotel)
                                <li class="trending-item">
                                    <div class="flex p-6 bg-white rounded-xl gap-x-7 max-lg:gap-x-5">
                                        <img data-src="{{ $hotelService->getLocationImage($hotel->location_id) }}" class="w-[33%] max-lg:w-[45%] h-[160px] rounded-xl object-cover lazy" alt="">
                                        <div class="flex flex-col justify-between">
                                            <strong class="text-2xl font-bold max-lg:text-lg">{{ $hotelService->getLocationName($hotel->location_id) }}</strong>
                                            <div class="flex items-center gap-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 11.9532L3.43074 13.9147C2.91697 14.1971 2.31846 13.7374 2.4171 13.1362L3.09765 8.98853L0.213886 6.0502C-0.203981 5.62442 0.0251203 4.87905 0.600728 4.79162L4.59003 4.18568L6.37322 0.408861C6.6306 -0.136287 7.3694 -0.136287 7.62678 0.408861L9.40997 4.18568L13.3993 4.79162C13.9749 4.87905 14.204 5.62442 13.7861 6.0502L10.9023 8.98853L11.5829 13.1362C11.6815 13.7374 11.083 14.1971 10.5693 13.9147L7 11.9532Z" fill="#FFD166"/>
                                                </svg>
                                                <span>{{ $hotel->rating }}(147)</span>
                                            </div>
                                            <div class="flex items-baseline">
                                                <strong class="text-2xl font-semibold leading-4">${{ $hotel->price }}</strong>
                                                <span class="font-medium text-[#92929A] leading-4">/night</span>
                                            </div>
                                            <a class="px-4 py-2 button-primary w-max lg:text-sm"
                                                href="{{route('hotel.details',[
                                                    'slug' => Str::slug($hotel->name),
                                                    'id' => $hotel->id
                                                ])}}"
                                            >Book Now</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
