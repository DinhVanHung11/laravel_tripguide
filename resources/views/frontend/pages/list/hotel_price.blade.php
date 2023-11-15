@if (!is_null($advancePrices) && count($advancePrices) > 0)
    <span class="text-2xl font-bold leading-10 hotel-price">
        {{ $advancePrices[0]->price }}
    </span>
    <span class="text-[#84878B] font-medium leading-10">For {{ $hotelService->getPeopleAdvancePrice($advancePrices[0]->number_people) }}</span>
@elseif(!is_null($price))
    <span class="text-2xl font-bold leading-10 hotel-price">
        {{ $price }}
    </span>
    <span class="text-[#84878B] font-medium leading-10">/night</span>
@else
    <span class="leading-10">Contact Us</span>
@endif
