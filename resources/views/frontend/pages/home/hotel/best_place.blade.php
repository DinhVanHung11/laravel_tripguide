@php
use App\Http\Services\CountryService;

$countryService = new CountryService;
$bestPlaces = $countryService->getBestPlaces(8);
@endphp

<section class="mb-16 best-place row-container">
    <div class="mb-8 text-center section-heading">
        <h2 class="section-title title-theme">Search a best place in the world</h2>
        <p class="section-desc max-w-[593px] mx-auto">
            Whether you’re looking for places for a vacation. We are here to Guide you about the details you need to check in and ease your trips in advance
        </p>
    </div>
    <div class="section-content">
        <div class="block section-block block-bestplace">
            @if(!is_null($bestPlaces) && count($bestPlaces) > 0)
                <ul class="bestplace-list">
                    @foreach ( $bestPlaces as $bestPlace )
                        @php
                            $destinationCount = $countryService->getDestination($bestPlace->id)
                        @endphp
                        <li class="bestplace-item">
                            <a class="bestplace-item-link"
                                href="{{ route('hotel.list',['location' => Str::slug($bestPlace->name)]) }}"
                            >
                                <img class="place-image w-[70px] h-[70px] lazy" data-src="{{ $bestPlace->image ?? '' }}" alt="">
                                <strong class="text-base font-bold place-name">{{ $bestPlace->name }}</strong>
                                <span class="place-destination">{{ $destinationCount }} Destinations</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
