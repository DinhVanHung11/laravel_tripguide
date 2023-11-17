<section class="mb-16 feature-destination row-container">
    <div class="mb-8 section-heading">
        <h2 class="section-title title-theme">Featured Destinations</h2>
        <p class="section-desc">
            Popular destinations open to visitors from Indonesia
        </p>
    </div>
    <div class="section-content">
        <div class="block section-block block-feature-destination">
            <div class="lg:flex gap-x-[30px]">
                <div class="col-left lg:w-[74.35%] flex flex-col gap-y-7 flex-shrink-0">
                    <div class="relative w-full h-[280px]">
                        <a class="" href="{{ URL::to('hotel.html?location=barcelona') }}">
                            <img data-src="{{ asset('images/location/Barcelona.png') }}" class="object-cover w-full h-full lazy rounded-2xl" alt="">
                        </a>
                        <span class="absolute top-5 left-5 text-[#FF543D] font-bold text-lg py-[2px] px-5 bg-white rounded-3xl">3.5</span>
                        <div class="absolute text-white left-5 bottom-5">
                            <strong class="text-[40px] mb-3 font0-bold">Barcelona Tour</strong>
                            <div class="flex items-center gap-x-2">
                                <img src="{{ asset('images/my-avatar.jpg') }}" class="rounded-full w-7 h-7" alt="">
                                <span class="text-xl">196 Activities</span>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex gap-x-[54px]">
                        <div class="relative lg:w-1/2 h-[408px] max-lg:mb-7">
                            <a class="" href="{{ URL::to('hotel.html?location=london-united-state') }}">
                                <img data-src="{{ asset('images/location/london.png') }}" class="object-cover w-full h-full rounded-2xl lazy" alt="">
                            </a>
                            <span class="absolute top-5 left-5 text-[#FF543D] font-bold text-lg py-[2px] px-5 bg-white rounded-3xl">3.5</span>
                            <div class="absolute text-white left-5 bottom-5">
                                <strong class="mb-3 text-2xl font0-bold">London, United State</strong>
                                <div class="flex items-center gap-x-2">
                                    <img src="{{ asset('images/my-avatar.jpg') }}" class="rounded-full w-7 h-7" alt="">
                                    <span class="text-sm">196 Activities</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative lg:w-1/2 h-[408px] max-lg:mb-7">
                            <a class="" href="{{ URL::to('hotel.html?location=australia') }}">
                                <img data-src="{{ asset('images/location/Australia.png') }}" class="object-cover w-full h-full rounded-2xl lazy" alt="">
                            </a>
                            <span class="absolute top-5 left-5 text-[#FF543D] font-bold text-lg py-[2px] px-5 bg-white rounded-3xl">3.5</span>
                            <div class="absolute text-white left-5 bottom-5">
                                <strong class="mb-3 text-2xl font0-bold">Australia Tour</strong>
                                <div class="flex items-center gap-x-2">
                                    <img src="{{ asset('images/my-avatar.jpg') }}" class="rounded-full w-7 h-7" alt="">
                                    <span class="text-sm">196 Activities</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col flex-1 h-full col-right gap-y-7">
                    <div class="h-[220px] relative w-full">
                        <a class="" href="{{ URL::to('hotel.html?location=australia') }}">
                            <img data-src="{{ asset('images/location/australia1.png') }}" class="object-cover w-full h-full rounded-2xl lazy" alt="">
                        </a>
                        <span class="absolute top-5 left-5 text-[#FF543D] font-bold text-xs py-[2px] px-5 bg-white rounded-3xl">3.5</span>
                        <div class="absolute text-white left-5 bottom-5">
                            <strong class="mb-3 text-2xl font0-bold">Australia Tour</strong>
                            <div class="flex items-center gap-x-2">
                                <img src="{{ asset('images/my-avatar.jpg') }}" class="rounded-full w-7 h-7" alt="">
                                <span class="text-sm">196 Activities</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-[220px] relative w-full">
                        <a class="" href="{{ URL::to('hotel.html?location=japan') }}">
                            <img data-src="{{ asset('images/location/Japan_1.png') }}" class="object-cover w-full h-full lazy rounded-2xl" alt="">
                        </a>
                        <span class="absolute top-5 left-5 text-[#FF543D] font-bold text-xs py-[2px] px-5 bg-white rounded-3xl">3.5</span>
                        <div class="absolute text-white left-5 bottom-5">
                            <strong class="mb-3 text-2xl font0-bold">Japan Tour</strong>
                            <div class="flex items-center gap-x-2">
                                <img src="{{ asset('images/my-avatar.jpg') }}" class="rounded-full w-7 h-7" alt="">
                                <span class="text-sm">196 Activities</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-[220px] relative w-full">
                        <a class="" href="{{ URL::to('hotel.html?location=china') }}">
                            <img data-src="{{ asset('images/location/china_1.png') }}" class="object-cover w-full h-full rounded-2xl lazy" alt="">
                        </a>
                        <span class="absolute top-5 left-5 text-[#FF543D] font-bold text-xs py-[2px] px-5 bg-white rounded-3xl">3.5</span>
                        <div class="absolute text-white left-5 bottom-5">
                            <strong class="mb-3 text-2xl font0-bold">China Tour</strong>
                            <div class="flex items-center gap-x-2">
                                <img src="{{ asset('images/my-avatar.jpg') }}" class="rounded-full w-7 h-7" alt="">
                                <span class="text-sm">196 Activities</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
