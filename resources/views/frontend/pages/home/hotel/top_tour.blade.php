@php
use App\Http\Services\TourService;

$tourService = new TourService;
$tours = $tourService->getAll();
@endphp

<section class="mb-16 top-tour row-container">
    <div class="mb-8 section-heading">
        <h2 class="section-title title-theme">Top Tour</h2>
        <p class="section-desc">
            Keep calm & travel on
        </p>
    </div>
    <div class="section-content">
        <div class="block section-block block-tour">
            @if (count($tours) > 0)
                <ul class="tour-list gap-x-[30px]">
                    @foreach ( $tours as $tour)
                        @php
                            $country = $tourService->getCountry($tour->country_id);
                        @endphp
                        <li class="tour-item">
                            <div class="relative tour-content">
                                <a  href="{{ route('hotel.list',['location' => Str::slug($country->name)]) }}" class="block w-full">
                                    <img data-src="{{ $tour->image }}" class="h-[495px] w-full rounded-xl lazy" alt="">
                                </a>
                                <div class="absolute rounded-3xl py-2 text-xl text-white tour-country left-7 top-7 px-7 bg- [#14141633]">
                                    {{ $country->name }}
                                </div>
                                <div class="absolute text-white tour-info bottom-7 left-7">
                                    <h3 class="mb-2 text-3xl font-bold">{{ $tour->tour_name }}</h3>
                                    <span>{{ $tour->number_popular }} Popular Places</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
