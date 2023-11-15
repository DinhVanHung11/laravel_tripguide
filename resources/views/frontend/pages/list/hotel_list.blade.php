@extends('frontend.pages.list', ['location' => $location])

@php
use App\Http\Services\HotelService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

$hotelService = new HotelService;
$hotels = $hotelService->getHotelsByLocation($location->id, 6);
@endphp

@section('frontend.category.list')
    <div class="catgory-list">
        @if (!is_null($hotels) && !empty($hotels) && count($hotels) > 0)
            <ul class="hotel-list items-list flex flex-col gap-y-[50px]">
                @foreach ( $hotels as $hotel )
                    <li class="hotel-item item">
                        @php
                            $hotelFeatures = $hotelService->getFilterOptions($hotel->optionsAttributes, 'feature');
                        @endphp
                        <div class="flex hotel-info item-info">
                            <img src="{{ $hotel->image }}" class="w-[43.3%] rounded-tl-xl rounded-bl-xl" alt="">
                            <div class="flex-1 p-6 bg-white border border-[#E7ECF3] rounded-br-xl rounded-tr-xl">
                                <a  class="inline-block mb-5"
                                    href="{{route('hotel.details',[
                                        'slug' => Str::slug($hotel->name),
                                        'id' => $hotel->id
                                    ])}}"
                                >
                                    <strong class="text-[40px] font-bold">{{ $hotel->name }}</strong>
                                </a>
                                <div class="flex items-center mb-10 gap-x-5">
                                    @if ($hotel->rating)
                                        <div class="flex items-center gap-x-2">
                                            <img src="{{ asset('images/icon-star.svg') }}" alt="">
                                            <span>{{ $hotel->rating }} (122 reviews)</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.52966 16.8498H1.01154V16.8492H0.252197V15.3311H1.01154V0.150391H2.52966V0.908203L2.53009 0.908203H13.2516L10.9754 5.46251L13.2526 10.0169H2.53009H2.52966V15.3311H3.28845V16.8492H2.52966V16.8498ZM2.52966 2.42383V8.49632H10.7957L9.27761 5.46014L10.7952 2.42383H2.52966Z" fill="#84878B"/>
                                        </svg>
                                        <span>
                                            {{ $hotelService->getLocationName($hotel->location_id) }},
                                            {{ $hotelService->getCountryName($hotel->location_id) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center mb-4 gap-x-5 gap-y-4">
                                    <div class="flex items-center gap-x-2">
                                        <img src="{{ asset('images/icon-location.svg') }}" alt="">
                                        <span>
                                            {{ $hotelService->getLocationName($hotel->location_id) }},
                                            {{ $hotelService->getCountryName($hotel->location_id) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <img src="{{ asset('images/icon-calendar.svg') }}" alt="">
                                        <span>15.05.2021-16.05.2021</span>
                                    </div>
                                </div>
                                <div class="flex items-center mb-10 gap-x-2">
                                    <img src="{{ asset('images/icon-departure.svg') }}" alt="">
                                    <span>Departure from {{ $hotelService->getCountryName($hotel->location_id) }}</span>
                                </div>
                                <div class="flex items-end justify-between">
                                    @if (!empty($hotelFeatures))
                                        <ul class="flex flex-col gap-y-2">
                                            @foreach (  $hotelFeatures as $feature)
                                                <li class="flex items-center gap-x-4">
                                                    <img src="{{ $feature->image }}" alt="">
                                                    <span class="capitalize">{{ $feature->label }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <div class="">
                                        <div class="w-[176px] flex items-end rounded-3xl py-1 gap-x-2 bg-[#F4F5F6] mb-5 justify-center">
                                            @include('frontend.pages.list.hotel_price', [
                                                'price' => $hotel->price,
                                                'advancePrices' => $hotel->advancePrices
                                            ])
                                        </div>
                                        <a class="w-[176px] button-primary rounded-3xl"
                                            href="{{route('hotel.details',[
                                                'slug' => Str::slug($hotel->name),
                                                'id' => $hotel->id
                                            ])}}"
                                        >
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="pager">
                {{$hotels->appends(request()->query())->links("pagination::bootstrap-4")}}
            </div>
        @else
            <p class="text-2xl">No result is found</p>
        @endif
    </div>
@endsection
