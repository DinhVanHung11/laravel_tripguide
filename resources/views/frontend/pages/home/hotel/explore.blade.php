@php
use App\Http\Services\HotelService;

$hotelService = new HotelService;
$hotels = $hotelService->getLimit(8);
@endphp

<section class="explore-world row-container">
    <div class="mb-8 section-heading">
        <h2 class="section-title title-theme">Explore The World</h2>
        <p class="section-desc">
            10,788 beautiful places to go
        </p>
    </div>
    <div class="section-content">
        <div class="block section-block block-explore">
            @if (count($hotels) > 0)
                <ul class="explore-list gap-x-[30px]">
                    @foreach ( $hotels as $hotel)
                        <li class="explore-item">
                            <div class="relative explore-content p-[14px] bg-white border border-[#E7ECF3] rounded-xl">
                                <a href="#" class="block mb-5">
                                    <img data-src="{{ $hotel->image }}" class="lazy h-[152px] w-full rounded-xl object-cover" alt="">
                                </a>
                                <div class="flex items-center mb-3 gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 12.4532L3.43074 14.4147C2.91697 14.6971 2.31846 14.2374 2.4171 13.6362L3.09765 9.48853L0.213886 6.5502C-0.203981 6.12442 0.0251203 5.37905 0.600728 5.29162L4.59003 4.68568L6.37322 0.908861C6.6306 0.363713 7.3694 0.363713 7.62678 0.908861L9.40997 4.68568L13.3993 5.29162C13.9749 5.37905 14.204 6.12442 13.7861 6.5502L10.9023 9.48853L11.5829 13.6362C11.6815 14.2374 11.083 14.6971 10.5693 14.4147L7 12.4532Z" fill="#FFD166"/>
                                    </svg>
                                    <span class="font-medium">{{ $hotel->rating }}</span>
                                </div>
                                <div class="flex items-center justify-between mb-1">
                                    <a href="#">
                                        <strong class="strong max-w-[150px] hotel-name text-xl">{{ $hotel->name }}</strong>
                                    </a>
                                    <div class="text-[#316BFF] px-[10px] hotel-rating rounded-lg text-lg font-medium">
                                        ${{ $hotel->price }}
                                    </div>
                                </div>
                                <span class="inline-block mb-2 font-medium text-[#84878B]">{{ $hotel->distance }} km to Town Center</span>
                                <div class="flex items-center text-[#84878B] gap-x-2 mb-2">
                                    <img src="{{ asset('images/icon-location.svg') }}" alt="">
                                    <span>{{ $hotelService->getLocationName($hotel->location_id) }}</span>
                                </div>
                                <div class="flex items-center text-[#84878B] gap-x-2">
                                    <img src="{{ asset('images/icon-room.svg') }}" alt="">
                                    <span>Rooms available: {{ $hotel->room }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
