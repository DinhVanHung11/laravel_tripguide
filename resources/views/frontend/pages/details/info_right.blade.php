<div class="w-[40%] info-right">
    <div class="px-10 max-md:px-5 py-5 order-summary bg-white border border-[#EAEAEA] rounded-2xl">
        <div class="flex items-center justify-between info-price pb-[16px] border-b border-[#E6E8EC] mb-5">
            <span class="final-price">
                <strong class="text-[34px] font-bold price-per-night">${{ $hotel->price ?? $hotel->price_sale }}</strong>
                <span class="text-[20px] text-[#84878B]">/night</span>
                @if ($hotel->price_sale)
                    <span class="old-price text-[18px] text-[#B1B5C3] pl-2 line-through">${{ $hotel->price }}</span>
                @endif
            </span>
            <span class="percent-sale px-[10px] py-[6px] rounded-3xl bg-[#145CE6] uppercase text-white text-sm font-medium {{ $hotel->price_sale ? '' : 'hidden' }} ">
                {{ $hotelService->getPercentSale($hotel) }}% off
            </span>
        </div>
        <div class="mb-5 info-time">
            <div class="flex items-centerinfo-scheduce gap-x-4">
                <div class="w-1/2">
                    <label for="" class="text-[#84878B] font-medium mb-3 block">Check-In</label>
                    <div class="bg-[#F4F5F6] rounded-xl">
                        <input type="date" class="bg-transparent input-booking-time" name="check_in" required>
                    </div>
                </div>
                <div class="w-1/2 ">
                    <label for="" class="text-[#84878B] font-medium mb-3 block">Check-Out</label>
                    <div class="bg-[#F4F5F6] rounded-xl">
                        <input type="date" class="bg-transparent input-booking-time" name="check_out" required>
                    </div>
                </div>
            </div>
            <div class="message-error error-time"></div>
        </div>
        <div class="mb-5 info-guest">
            <label for="" class="text-[#84878B] font-medium mb-3 block">Guest</label>
            <div class="info-guest-wrap">
                <div class="guest-display bg-[#f4f5f6] py-3 px-[14px] flex items-center justify-between rounded-xl text-sm cursor-pointer">
                    <div class="guest-display-text">
                        <span class="guest-no-selected">--Choose amount people--</span>
                        <span class="guest-adults"></span>
                        <span class="comma-icon comma-first">,</span>
                        <span class="guest-children" ></span>
                        <span class="comma-icon comma-second">,</span>
                        <span class="guest-infant" ></span>
                    </div>
                    <img class="guest-option-icon" src="{{ asset('images/icon-down.svg') }}" alt="">
                </div>
                <div class="message-error error-guest"></div>
                <ul class="p-5 bg-white shadow-md guest-options rounded-xl">
                    <li class="flex justify-between pb-3 guest-option-item">
                        <label for="" class="flex flex-col gap-y-1">
                            <span class="text-[#777E90] font-medium">Adults</span>
                            <span class="text-sm text-[#B1B5C3]">Ages 13 or above</span>
                        </label>
                        <div class="flex items-center gap-x-3">
                            <button class="decrease-guest" type="button" data-action="decrease">
                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                    <path d="M31.9849 16.4766C31.9849 25.0469 25.0519 31.9927 16.5018 31.9927C7.95159 31.9927 1.01855 25.0469 1.01855 16.4766C1.01855 7.90629 7.95159 0.960449 16.5018 0.960449C25.0519 0.960449 31.9849 7.90629 31.9849 16.4766Z" stroke="currentColor"/>
                                    <path d="M21.7599 15.4746H11.2418C11.0425 15.4746 10.8514 15.5801 10.7105 15.7678C10.5696 15.9555 10.4905 16.2101 10.4905 16.4756C10.4905 16.7411 10.5696 16.9957 10.7105 17.1834C10.8514 17.3712 11.0425 17.4766 11.2418 17.4766H21.7599C21.9592 17.4766 22.1503 17.3712 22.2912 17.1834C22.4321 16.9957 22.5112 16.7411 22.5112 16.4756C22.5112 16.2101 22.4321 15.9555 22.2912 15.7678C22.1503 15.5801 21.9592 15.4746 21.7599 15.4746Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <span class="guest-number-text" data-text="adults">0</span>
                            <button class="increase-guest" type="button" data-action="increase">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                                    <path d="M31.4996 16.4766C31.4996 25.0469 24.5666 31.9927 16.0164 31.9927C7.46624 31.9927 0.533203 25.0469 0.533203 16.4766C0.533203 7.90629 7.46624 0.960449 16.0164 0.960449C24.5666 0.960449 31.4996 7.90629 31.4996 16.4766Z" stroke="currentColor"/>
                                    <path d="M20.398 15.8521H16.6416V12.0983C16.6416 11.9324 16.5756 11.7732 16.4582 11.6559C16.3408 11.5386 16.1815 11.4727 16.0155 11.4727C15.8495 11.4727 15.6902 11.5386 15.5728 11.6559C15.4554 11.7732 15.3894 11.9324 15.3894 12.0983V15.8521H11.633C11.467 15.8521 11.3077 15.918 11.1903 16.0353C11.0729 16.1527 11.007 16.3118 11.007 16.4777C11.007 16.6437 11.0729 16.8028 11.1903 16.9201C11.3077 17.0374 11.467 17.1034 11.633 17.1034H15.3894V20.8572C15.3894 21.0231 15.4554 21.1822 15.5728 21.2995C15.6902 21.4169 15.8495 21.4828 16.0155 21.4828C16.1815 21.4828 16.3408 21.4169 16.4582 21.2995C16.5756 21.1822 16.6416 21.0231 16.6416 20.8572V17.1034H20.398C20.564 17.1034 20.7233 17.0374 20.8407 16.9201C20.9581 16.8028 21.024 16.6437 21.024 16.4777C21.024 16.3118 20.9581 16.1527 20.8407 16.0353C20.7233 15.918 20.564 15.8521 20.398 15.8521Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <input type="hidden" class="guest-number-input guest-number-adults" name="guest[adults]" value="0">
                        </div>
                    </li>
                    <li class="flex justify-between py-3 guest-option-item">
                        <label for="" class="flex flex-col gap-y-1">
                            <span class="text-[#777E90] font-medium">Children</span>
                            <span class="text-sm text-[#B1B5C3]">Ages 2-12</span>
                        </label>
                        <div class="flex items-center gap-x-3">
                            <button class="decrease-guest" type="button" data-action="decrease">
                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                    <path d="M31.9849 16.4766C31.9849 25.0469 25.0519 31.9927 16.5018 31.9927C7.95159 31.9927 1.01855 25.0469 1.01855 16.4766C1.01855 7.90629 7.95159 0.960449 16.5018 0.960449C25.0519 0.960449 31.9849 7.90629 31.9849 16.4766Z" stroke="currentColor"/>
                                    <path d="M21.7599 15.4746H11.2418C11.0425 15.4746 10.8514 15.5801 10.7105 15.7678C10.5696 15.9555 10.4905 16.2101 10.4905 16.4756C10.4905 16.7411 10.5696 16.9957 10.7105 17.1834C10.8514 17.3712 11.0425 17.4766 11.2418 17.4766H21.7599C21.9592 17.4766 22.1503 17.3712 22.2912 17.1834C22.4321 16.9957 22.5112 16.7411 22.5112 16.4756C22.5112 16.2101 22.4321 15.9555 22.2912 15.7678C22.1503 15.5801 21.9592 15.4746 21.7599 15.4746Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <span class="guest-number-text" data-text="children">0</span>
                            <button class="increase-guest" type="button" data-action="increase">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                                    <path d="M31.4996 16.4766C31.4996 25.0469 24.5666 31.9927 16.0164 31.9927C7.46624 31.9927 0.533203 25.0469 0.533203 16.4766C0.533203 7.90629 7.46624 0.960449 16.0164 0.960449C24.5666 0.960449 31.4996 7.90629 31.4996 16.4766Z" stroke="currentColor"/>
                                    <path d="M20.398 15.8521H16.6416V12.0983C16.6416 11.9324 16.5756 11.7732 16.4582 11.6559C16.3408 11.5386 16.1815 11.4727 16.0155 11.4727C15.8495 11.4727 15.6902 11.5386 15.5728 11.6559C15.4554 11.7732 15.3894 11.9324 15.3894 12.0983V15.8521H11.633C11.467 15.8521 11.3077 15.918 11.1903 16.0353C11.0729 16.1527 11.007 16.3118 11.007 16.4777C11.007 16.6437 11.0729 16.8028 11.1903 16.9201C11.3077 17.0374 11.467 17.1034 11.633 17.1034H15.3894V20.8572C15.3894 21.0231 15.4554 21.1822 15.5728 21.2995C15.6902 21.4169 15.8495 21.4828 16.0155 21.4828C16.1815 21.4828 16.3408 21.4169 16.4582 21.2995C16.5756 21.1822 16.6416 21.0231 16.6416 20.8572V17.1034H20.398C20.564 17.1034 20.7233 17.0374 20.8407 16.9201C20.9581 16.8028 21.024 16.6437 21.024 16.4777C21.024 16.3118 20.9581 16.1527 20.8407 16.0353C20.7233 15.918 20.564 15.8521 20.398 15.8521Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <input type="hidden" class="guest-number-input guest-number-children" name="guest[children]" value="0">
                        </div>
                    </li>
                    <li class="flex justify-between pt-3 guest-option-item">
                        <label for="" class="flex flex-col gap-y-1">
                            <span class="text-[#777E90] font-medium">Infants</span>
                            <span class="text-sm text-[#B1B5C3]">Under 2</span>
                        </label>
                        <div class="flex items-center gap-x-3">
                            <button class="decrease-guest" type="button" data-action="decrease">
                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                    <path d="M31.9849 16.4766C31.9849 25.0469 25.0519 31.9927 16.5018 31.9927C7.95159 31.9927 1.01855 25.0469 1.01855 16.4766C1.01855 7.90629 7.95159 0.960449 16.5018 0.960449C25.0519 0.960449 31.9849 7.90629 31.9849 16.4766Z" stroke="currentColor"/>
                                    <path d="M21.7599 15.4746H11.2418C11.0425 15.4746 10.8514 15.5801 10.7105 15.7678C10.5696 15.9555 10.4905 16.2101 10.4905 16.4756C10.4905 16.7411 10.5696 16.9957 10.7105 17.1834C10.8514 17.3712 11.0425 17.4766 11.2418 17.4766H21.7599C21.9592 17.4766 22.1503 17.3712 22.2912 17.1834C22.4321 16.9957 22.5112 16.7411 22.5112 16.4756C22.5112 16.2101 22.4321 15.9555 22.2912 15.7678C22.1503 15.5801 21.9592 15.4746 21.7599 15.4746Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <span class="guest-number-text" data-text="infant">0</span>
                            <button class="increase-guest" type="button" data-action="increase">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                                    <path d="M31.4996 16.4766C31.4996 25.0469 24.5666 31.9927 16.0164 31.9927C7.46624 31.9927 0.533203 25.0469 0.533203 16.4766C0.533203 7.90629 7.46624 0.960449 16.0164 0.960449C24.5666 0.960449 31.4996 7.90629 31.4996 16.4766Z" stroke="currentColor"/>
                                    <path d="M20.398 15.8521H16.6416V12.0983C16.6416 11.9324 16.5756 11.7732 16.4582 11.6559C16.3408 11.5386 16.1815 11.4727 16.0155 11.4727C15.8495 11.4727 15.6902 11.5386 15.5728 11.6559C15.4554 11.7732 15.3894 11.9324 15.3894 12.0983V15.8521H11.633C11.467 15.8521 11.3077 15.918 11.1903 16.0353C11.0729 16.1527 11.007 16.3118 11.007 16.4777C11.007 16.6437 11.0729 16.8028 11.1903 16.9201C11.3077 17.0374 11.467 17.1034 11.633 17.1034H15.3894V20.8572C15.3894 21.0231 15.4554 21.1822 15.5728 21.2995C15.6902 21.4169 15.8495 21.4828 16.0155 21.4828C16.1815 21.4828 16.3408 21.4169 16.4582 21.2995C16.5756 21.1822 16.6416 21.0231 16.6416 20.8572V17.1034H20.398C20.564 17.1034 20.7233 17.0374 20.8407 16.9201C20.9581 16.8028 21.024 16.6437 21.024 16.4777C21.024 16.3118 20.9581 16.1527 20.8407 16.0353C20.7233 15.918 20.564 15.8521 20.398 15.8521Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <input type="hidden" class="guest-number-input guest-number-infants" name="guest[infants]" value="0">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @if ($hotel->extraFeatures && count($hotel->extraFeatures) > 0)
            <div class="mb-5 info-extra-futures">
                <h3 for="" class="text-[#84878B] font-medium mb-3 block">Extra Features</h3>
                <ul class="flex flex-col gap-y-4">
                    @foreach ($hotel->extraFeatures as $extraFeature)
                        <li class="flex items-center justify-between text-[#353945]">
                            <div class="flex items-center cursor-pointer gap-x-2">
                                <input type="checkbox"
                                    class="!border !border-[#B1B5C3] rounded-2xl"
                                    name="extra_features[]"
                                    id="extra_feature_{{ $extraFeature->id }}"
                                    value="{{ $extraFeature->id }}"
                                    data-price="{{ $extraFeature->price }}"
                                    data-calculate="{{ $extraFeature->calculated_people }}"
                                >
                                <label for="extra_feature_{{ $extraFeature->id }}">{{ $extraFeature->label }}</label>
                            </div>
                            <span class="text-[#B1B5C3]">{{ $extraFeature->price != 0 ? '$'.$extraFeature->price : 'Free' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="info-price">
            <h3 for="" class="text-[#84878B] font-medium mb-3 block">Price</h3>
            <div class="bg-[#F4F5F6] rounded-xl flex flex-col gap-y-3 px-5 py-4 mb-3">
                <div class="flex items-center justify-between">
                    <span class="price-for-night-label">1 Nights</span>
                    <span class="price-for-night-number">${{ $hotel->price }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="price-discount-percent">Discount {{ $hotelService->getPercentSale($hotel) }}%</span>
                    <span class="price-discount-number">${{ $hotel->price_sale ? $hotel->price - $hotel->price_sale : '0' }}</span>
                </div>
                @if ($hotel->extraFeatures && count($hotel->extraFeatures) > 0)
                    @foreach ($hotel->extraFeatures as $extraFeature)
                        <div class="items-center justify-between hidden info-feature-selected" data-feature={{ $extraFeature->id }}>
                            <span class="price-exfeature-label">{{ $extraFeature->label }}</span>
                            <span class="price-exfeature-number">${{ $extraFeature->price }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="flex items-center justify-between">
                <span class="font-medium text-[#777E90]">Total payment</span>
                <span class="font-medium total-price-text">${{ $hotel->price_sale ?? $hotel->price }}</span>
            </div>
        </div>
        <input type="hidden" name="total" value="{{  $hotel->price_sale ?? $hotel->price }}">
        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
        <button type="button" id="action-book" class="button-primary !bg-[#316BFF] w-full mt-6">Book Now</button>
        @csrf
    </div>
</div>
