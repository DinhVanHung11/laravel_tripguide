@php
    $hotelFeatures = $hotelService->getFilterOptions($hotel->optionsAttributes, 'feature');
    $hotelAmenities = $hotelService->getFilterOptions($hotel->optionsAttributes, 'amenities');
@endphp

<div class="hotel-info-left w-[60%]">
    <div class="info-title pb-6 mb-8 border-b border-[#E6E8EC]">
        <h2 class="text-[40px] font-bold mb-3 laeading-[60px]">Exclusive room in house</h2>
        <strong class="font-medium text-2xl text-[#777E90]">
            {{ $hotelService->getLocationName($hotel->location_id) }},
            {{ $hotelService->getCountryName($hotel->location_id) }}
        </strong>
    </div>
    <div class="mb-[60px] info-description">
        <ul class="flex mb-5 actions-list gap-x-10">
            @if ($hotel->description)
                <li class="action-item">
                    <a href="#hotel-features">Description</a>
                </li>
            @endif
            <li class="action-item">
                <a href="#hotel-features">Features</a>
            </li>
            <li class="action-item">
                <a href="#hotel-rooms">Room & Price</a>
            </li>
            <li class="action-item">
                <a href="#hotel-reviews">Reviews</a>
            </li>
        </ul>
        <p class="mb-10 hotel-desc" id="hotel-desc">
            {{ $hotel->description }}
        </p>
        @if ($hotelFeatures && count($hotelFeatures) > 0)
            <div class="hotel-features" id="#hotel-features">
                <h3 class="mb-6 text-2xl font-medium">Hotel features</h3>
                <ul class="flex items-center hotel-features-list flex-wrap gap-x-[45px] gap-y-5">
                    @foreach ( $hotelFeatures as $feature)
                        <li class="flex items-center gap-x-2">
                            <img src="{{ $feature->image }}" alt="">
                            <span class="capitalize">{{ $feature->label }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @if ($hotelAmenities)
        <div class="hotel-amenities pt-[60px] border-t border-[#E6E8EC] ">
            <h3 class="mb-6 text-2xl font-medium">Amenities</h3>
            <ul class="flex flex-wrap items-center hotel-features-list gap-y-6">
                @foreach ( $hotelAmenities as $amenity)
                    <li class="flex items-center w-1/2 gap-x-2">
                        <img src="{{ $amenity->image }}" alt="">
                        <span class="capitalize">{{ $amenity->label }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
