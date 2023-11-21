@php
use App\Http\Services\AttributeService;

$attrService = new AttributeService;
@endphp

<div class="mb-10 hotel-room" id="hotel-room">
    <h2 class="text-[40px] font-bold mb-3 laeading-[60px] max-md:text-2xl">Select Room</h2>
    <div class="mb-2 message-error error-room"></div>
    <ul class="flex flex-col hotel-room-list gap-y-7">
        @if ($hotel->rooms && count($hotel->rooms) > 0)
            @foreach ($hotel->rooms as $room)
                <li class="flex hotel-room-item justify-between relative bg-white rounded-2xl p-7 border border-[#E7ECF3] cursor-pointer">
                    <div class="room-info">
                        <strong class="inline-block mb-4 text-2xl font-medium room-name">{{ $room->room_name }}</strong>
                        @if ($room->features)
                            <div class="room-features">
                                <p class="text-sm text-[#84878B] mb-4">Offer conditions:</p>
                                <ul class="{{ count($room->features) > 3 ? 'grid grid-cols-2 gap-x-16' : 'flex flex-col' }} room-features-list gap-y-2">
                                    @foreach ( $room->features as $roomFeature)
                                        @php
                                            $feature= $attrService->getAttributeOption($roomFeature->feature_id);
                                        @endphp
                                        <li class="flex items-center gap-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6" fill="none">
                                                <path d="M7.81674 0.173631C7.76382 0.118613 7.70087 0.0749445 7.6315 0.0451436C7.56213 0.0153428 7.48773 0 7.41258 0C7.33744 0 7.26303 0.0153428 7.19367 0.0451436C7.1243 0.0749445 7.06134 0.118613 7.00842 0.173631L2.7676 4.5526L0.985878 2.70944C0.930934 2.65471 0.866074 2.61167 0.795002 2.58279C0.723929 2.55391 0.648036 2.53974 0.571655 2.54111C0.495274 2.54247 0.419902 2.55933 0.349841 2.59073C0.27978 2.62213 0.216402 2.66746 0.163327 2.72411C0.110252 2.78077 0.0685192 2.84765 0.0405104 2.92094C0.0125016 2.99423 -0.00123442 3.07249 8.70471e-05 3.15126C0.00140852 3.23002 0.0177615 3.30774 0.0482121 3.37999C0.0786626 3.45223 0.122615 3.51759 0.177558 3.57232L2.36344 5.82637C2.41635 5.88139 2.47931 5.92506 2.54868 5.95486C2.61805 5.98466 2.69245 6 2.7676 6C2.84274 6 2.91714 5.98466 2.98651 5.95486C3.05588 5.92506 3.11884 5.88139 3.17175 5.82637L7.81674 1.03651C7.87452 0.981543 7.92064 0.91483 7.95218 0.840576C7.98372 0.766322 8 0.686136 8 0.605071C8 0.524006 7.98372 0.44382 7.95218 0.369566C7.92064 0.295311 7.87452 0.228599 7.81674 0.173631Z" fill="#03A782"/>
                                            </svg>
                                            <span class="text-sm text-[#3B3E44]">{{ $feature->label}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="text-right room-price">
                        <div class="mb-4">
                            <strong class="text-[34px] font-bold">${{ $room->price_sale ?? $room->price }}</strong>
                            <span class="text-[#84878B] text-[20px]"> /night</span>
                        </div>
                        @if ($room->price_sale)
                            <p class="text-lg text-[#FFAF4E] font-medium">Save ${{ $room->price - $room->price_sale }}</p>
                            <p class="text-xs text-[#84878B] mb-5">on TripGuide.com ${{ $room->price }}</p>
                        @endif
                        <span class="text-lg font-medium bg-[#316BFF] py-2 px-4 rounded-md text-white">Select</span>
                    </div>
                    <input
                        type="radio"
                        class="absolute top-0 left-0 block w-full h-full bg-transparent cursor-pointer rounded-2xl"
                        name="room"
                        value="{{ $room->id }}"
                        data-price="{{ $room->price_sale ?? $room->price }}"
                        data-old-price="{{ $room->price }}"
                    >
                    <img src="{{ asset('images/radio-checked-icon.png') }}" alt="" class="absolute top-0 right-0 w-10 icon-checked">
                </li>
            @endforeach
        @endif
        <li class="flex hotel-room-item justify-between relative bg-white rounded-2xl p-7 border border-[#E7ECF3] cursor-pointer">
            <div class="room-info">
                <strong class="inline-block mb-4 text-2xl font-medium room-name">Basic Room</strong>
            </div>
            <div class="text-right room-price">
                <div class="mb-4">
                    <strong class="text-[34px] font-bold">${{ $hotel->price_sale ?? $hotel->price }}</strong>
                    <span class="text-[#84878B] text-[20px]"> /night</span>
                </div>
                @if ($hotel->price_sale)
                    <p class="text-lg text-[#FFAF4E] font-medium">Save ${{ $hotel->price - $hotel->price_sale }}</p>
                    <p class="text-xs text-[#84878B] mb-5">on TripGuide.com ${{ $hotel->price }}</p>
                @endif
                <span class="text-lg font-medium bg-[#316BFF] py-2 px-4 rounded-md text-white">Select</span>
            </div>
            <input
                type="radio"
                class="absolute top-0 left-0 block w-full h-full bg-transparent cursor-pointer rounded-2xl"
                name="room"
                value="0"
                data-price="{{ $hotel->price_sale ?? $hotel->price }}"
                data-old-price="{{ $hotel->price }}"
                checked
            >
            <img src="{{ asset('images/radio-checked-icon.png') }}" alt="" class="absolute top-0 right-0 w-10 icon-checked">
        </li>
    </ul>
</div>

